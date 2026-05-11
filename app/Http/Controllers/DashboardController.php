<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Contribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

    // ==========================================
    // METHOD BARU KHUSUS HALAMAN ANGOTA (MEMBER)
    // ==========================================

    /**
     * Tampilan Beranda Anggota (Sesuai Mockup Mobile)
     */
    public function memberDashboard()
    {
        // --- BYPASS DATABASE START ---
        // $user = Auth::user();

        // 2. Buat objek member palsu
        $member = new \stdClass();
        $member->name = 'A.A Agung Sastra';

        // 3. Set total tunggakan palsu
        $totalTunggakan = 50000; // Contoh: Tunggakan Rp 50.000
        // --- BYPASS DATABASE END ---

        return view('member.dashboard', compact('member', 'totalTunggakan'));
    }

    /**
     * Tampilan Histori Pembayaran Anggota
     */
    public function memberHistory()
    {
        // --- BYPASS DATABASE START ---
        // Buat objek member palsu
        $member = new \stdClass();
        $member->name = 'A.A Agung Sastra';

        // Set summary palsu
        $totalLunas = 350000;
        $totalTunggakan = 50000;

        // Buat koleksi histori iuran palsu (dummy)
        $historiIuran = collect([
            (object)[
                'month' => 'Mei',
                'year' => '2026',
                'amount' => 50000,
                'status' => 'UNPAID',
                'paid_at' => null
            ],
            (object)[
                'month' => 'April',
                'year' => '2026',
                'amount' => 50000,
                'status' => 'PAID',
                'paid_at' => '2026-04-05 10:00:00'
            ],
            (object)[
                'month' => 'Maret',
                'year' => '2026',
                'amount' => 100000, // Iuran dobel misalnya
                'status' => 'PAID',
                'paid_at' => '2026-03-10 14:30:00'
            ],
            (object)[
                'month' => 'Februari',
                'year' => '2026',
                'amount' => 50000,
                'status' => 'PAID',
                'paid_at' => '2026-02-01 09:15:00'
            ],
            (object)[
                'month' => 'Januari',
                'year' => '2026',
                'amount' => 50000,
                'status' => 'PAID',
                'paid_at' => '2026-01-05 08:00:00'
            ]
        ]);
        // --- BYPASS DATABASE END ---

        return view('member.history', compact('member', 'historiIuran', 'totalLunas', 'totalTunggakan'));
    }

    /**
     * Tampilan Pengaturan Akun Anggota
     */
    public function memberSettings()
    {
        // --- BYPASS DATABASE START ---
        // Buat objek user palsu
        $user = new \stdClass();
        $user->email = 'A.A.dummy@example.com';
        $user->created_at = '2026-01-01 10:00:00';

        // Buat objek member palsu
        $member = new \stdClass();
        $member->name = 'A.A Agung Sastra';
        // --- BYPASS DATABASE END ---

        return view('member.settings', compact('user', 'member'));
    }

    public function memberNotifications()
    {
        // Mengembalikan tampilan halaman notifikasi
        return view('member.notifications');
    }
}
