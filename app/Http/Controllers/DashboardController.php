<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Contribution;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil filter bulan & tahun dari request, default ke bulan & tahun sekarang (Real-time)
        $bulanSekarang = $request->get('bulan', date('F')); // Contoh: "May"
        $tahunSekarang = $request->get('tahun', date('Y')); // Contoh: "2026"

        // 2. Card 1: Total Anggota Terdaftar (Semua anggota aktif/terdaftar)
        $totalAnggota = Member::count();

        // 3. Card 2: Total Kas STT (Akumulasi seluruh iuran yang berstatus PAID)
        $totalKas = Contribution::where('status', 'PAID')->sum('amount');

        // 4. Card 3: Statistik Iuran Bulan Terpilih (Lunas vs Belum Lunas/Menunggak)
        $totalLunas = Contribution::where('month', $bulanSekarang)
            ->where('year', $tahunSekarang)
            ->where('status', 'PAID')
            ->count();

        // Anggota yang menunggak/belum bayar pada bulan terpilih
        $totalBelumLunas = $totalAnggota - $totalLunas;

        // Hitung persentase kelunasan untuk lingkaran progress chart
        $persenLunas = $totalAnggota > 0 ? round(($totalLunas / $totalAnggota) * 100) : 0;
        $persenBelumLunas = 100 - $persenLunas;

        // 5. Tabel: Daftar Tunggakan Terbaru (Anggota yang berstatus UNPAID di bulan terpilih)
        // ambil 4-5 data teratas saja 
        $tunggakanTerbaru = Member::whereDoesntHave('contributions', function ($query) use ($bulanSekarang, $tahunSekarang) {
            // Cari members yang TIDAK punya kontribusi sukses (PAID) di bulan & tahun ini
            $query->where('month', $bulanSekarang)
                ->where('year', $tahunSekarang)
                ->where('status', 'PAID');
        })
            ->with(['contributions' => function ($query) use ($bulanSekarang, $tahunSekarang) {
                // Opsional: Tetap ambil data kontribusi yang 'UNPAID' jika ingin ditampilkan di view
                $query->where('month', $bulanSekarang)
                    ->where('year', $tahunSekarang)
                    ->where('status', 'UNPAID');
            }])
            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan member terbaru atau sesuaikan kolomnya
            ->take(4)
            ->get();

        // 6. Terjemahkan nama bulan Inggris dari DB/Request ke Indonesia 
        $daftarBulanIndo = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        ];
        $bulanIndoStr = $daftarBulanIndo[$bulanSekarang] ?? $bulanSekarang;

        return view('admin.index', compact(
            'totalAnggota',
            'totalKas',
            'totalLunas',
            'totalBelumLunas',
            'persenLunas',
            'persenBelumLunas',
            'tunggakanTerbaru',
            'bulanSekarang',
            'tahunSekarang',
            'bulanIndoStr'
        ));
    }
    /**
     * Method untuk menyimpan atau memperbarui informasi penting dari admin
     */

    public function updateAnnouncement(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:500'
        ], [
            'content.required' => ' Isi informasi tidak boleh kosong.'
        ]);

        //simpan data baru ke database
        Announcement::create([
            'content' => $request->content
        ]);

        return back()->with('success', 'Informasi penting berhasil diperbarui!');
    }

    /**
     * Tampilan Beranda Anggota
     */
    public function memberDashboard()
    {
        //Set total tunggakan
        $totalTunggakan = 50000; // Contoh: Tunggakan Rp 50.000

        //untuk mengambil data terakhir dari database
        $latestAnnouncement = Announcement::latest()->first();

        //jika belum ada informasi
        $infoPenting = $latestAnnouncement ? $latestAnnouncement->content : "Belum ada informasi terbaru dari pengurus.";

        return view('member.dashboard', compact('totalTunggakan', 'infoPenting'));
    }

    /**
     * Tampilan Histori Pembayaran Anggota
     */
    public function memberHistory()
    {
        $userId = Auth::id();
        $memberId = Member::where('user_id', $userId)->value('id');
        $year = Carbon::now()->format('Y');
        $defaultAmount = 50000;

        $existingContributions = Contribution::where('member_id', $memberId)
            ->where('year', $year)
            ->get()
            ->keyBy(function ($item) {
                return strtolower($item->month);
            });

        $monthMap = [
            'december'  => 'Desember',
            'november'  => 'November',
            'october'   => 'Oktober',
            'september' => 'September',
            'august'    => 'Agustus',
            'july'      => 'Juli',
            'june'      => 'Juni',
            'may'       => 'Mei',
            'april'     => 'April',
            'march'     => 'Maret',
            'february'  => 'Februari',
            'january'   => 'Januari'
        ];

        $contributions = [];

        foreach ($monthMap as $englishMonth => $indonesianMonth) {
            if ($existingContributions->has($englishMonth)) {
                $dbData = $existingContributions->get($englishMonth);

                $contributions[] = (object)[
                    'month'   => $indonesianMonth,
                    'year'    => $dbData->year,
                    'amount'  => $dbData->amount,
                    'status'  => $dbData->status,
                    'paid_at' => $dbData->created_at ? $dbData->created_at->toDateTimeString() : null
                ];
            } else {
                $contributions[] = (object)[
                    'month'   => $indonesianMonth,
                    'year'    => $year,
                    'amount'  => $defaultAmount,
                    'status'  => 'UNPAID',
                    'paid_at' => null
                ];
            }
        }

        return view('member.history', compact('contributions'));
    }

    /**
     * Tampilan Pengaturan Akun Anggota
     */

    public function memberSettings()
    {
        // Mengambil data user yang sedang login beserta relasi member-nya
        $user = Auth::user();
        $member = $user->member;

        return view('member.settings', compact('user', 'member'));
    }

    /**
     * Memproses perubahan password
     */
    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => ['required', 'current_password'], // Cek apakah password lama benar
            'password' => ['required', 'confirmed', Password::min(8)], // Password baru min 8 karakter & cocok dengan konfirmasi
        ], [
            'current_password.current_password' => 'Password lama yang Anda masukkan salah.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password.min' => 'Password baru minimal harus 8 karakter.',
        ]);

        // Update password di tabel users
        $user = $request->user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password Anda berhasil diperbarui.');
    }
}
