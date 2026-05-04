<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Contribution;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    /**
     * Menampilkan halaman utama Manajemen Iuran.
     * Fungsi ini menangani filter bulan, tahun, dan status pembayaran.
     */
    public function index(Request $request)
    {
        // 1. PENGATURAN FILTER
        // Mengambil input dari request, jika kosong gunakan waktu saat ini (Real-time)
        $bulanSekarang = $request->get('bulan', date('F'));
        $tahunSekarang = $request->get('tahun', date('Y'));
        $statusFilter = $request->get('status');


        $search = $request->get('search');
        // 2. QUERY UTAMA DAFTAR ANGGOTA (UNTUK TABEL)
        $query = Member::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        // LOGIKA FILTER: Jika admin memilih "Status: Lunas"
        if ($statusFilter === 'PAID') {
            $query->whereHas('contributions', function ($q) use ($bulanSekarang, $tahunSekarang) {
                $q->where('month', $bulanSekarang)
                    ->where('year', $tahunSekarang)
                    ->where('status', 'PAID');
            });
        }
        // LOGIKA FILTER: Jika admin memilih "Status: Menunggak"
        // (Mencari anggota yang TIDAK memiliki record 'PAID' di bulan & tahun tersebut)
        elseif ($statusFilter === 'UNPAID') {
            $query->whereDoesntHave('contributions', function ($q) use ($bulanSekarang, $tahunSekarang) {
                $q->where('month', $bulanSekarang)
                    ->where('year', $tahunSekarang)
                    ->where('status', 'PAID');
            });
        }

        // AMBIL DATA: Load relasi iuran dan jalankan pagination
        // withQueryString() berfungsi agar saat pindah halaman, filter tetap aktif
        $members = $query->with(['contributions' => function ($q) use ($bulanSekarang, $tahunSekarang) {
            $q->where('month', $bulanSekarang)->where('year', $tahunSekarang);
        }])->orderBy('name', 'asc')->paginate(20)->withQueryString();


        // 3. LOGIKA KARTU STATISTIK (Dihitung berdasarkan bulan & tahun yang dipilih)

        // Card 1: Hitung berapa orang yang sudah lunas (status PAID)
        $totalLunas = Contribution::where('month', $bulanSekarang)
            ->where('year', $tahunSekarang)
            ->where('status', 'PAID')
            ->count();

        // Card 2: Hitung orang menunggak (Total semua anggota dikurangi yang sudah lunas)
        $totalMenunggak = Member::count() - $totalLunas;

        // Card 3: Hitung total uang yang masuk (Sum kolom amount)
        $danaTerkumpul = Contribution::where('month', $bulanSekarang)
            ->where('year', $tahunSekarang)
            ->where('status', 'PAID')
            ->sum('amount');


        // 4. KIRIM DATA KE VIEW
        return view('admin.contributions.index', compact(
            'members',
            'totalLunas',
            'totalMenunggak',
            'danaTerkumpul',
            'bulanSekarang',
            'tahunSekarang',
            'statusFilter',
            'search'
        ));
    }

    public function payCash(Request $request, $memberId)
    {
        // Ambil data bulan dan tahun dari request (agar sesuai dengan filter yang sedang dibuka)
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun');

        // Simpan data iuran baru
        Contribution::create([
            'member_id' => $memberId,
            'month' => $bulan,
            'year' => $tahun,
            'amount' => 50000, 
            'status' => 'PAID',
            'payment_method' => 'CASH' 
        ]);

        return redirect()->back()->with('success', 'Pembayaran tunai berhasil dicatat!');
    }
}
