<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Contribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
        ]);

        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun');

        // Update existing iuran jika sudah ada, atau buat baru jika belum ada.
        Contribution::updateOrCreate(
            [
                'member_id' => $memberId,
                'month' => $bulan,
                'year' => $tahun,
            ],
            [
                'amount' => 50000,
                'status' => 'PAID',
                'payment_method' => 'CASH',
                'reason_cancel' => null,
            ]
        );

        return redirect()->route('admin.contributions.index');
    }

    public function cancelPayment(Request $request, $id)
    {
        // Validasi alasan wajib diisi
        $request->validate([
            'reason_cancel' => 'required|string|min:5'
        ]);

        $contribution = Contribution::findOrFail($id);

        // Opsi A: Update status dan simpan alasan agar ada histori
        $contribution->update([
            'status' => 'UNPAID', // Kembalikan ke menunggak
            'reason_cancel' => $request->reason_cancel,
            'payment_method' => null // Reset metode pembayaran
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil dibatalkan dengan alasan: ' . $request->reason_cancel);
    }


    public function storeKolektif(Request $request)
    {
        $request->validate([
            'bulan_kolektif' => 'required',
            'tahun_kolektif' => 'required',
            'nominal_kolektif' => 'required|numeric',
        ]);

        $bulan = $request->get('bulan_kolektif');
        $tahun = $request->get('tahun_kolektif');
        $nominal = $request->get('nominal_kolektif');

        // Ambil hanya ID untuk efisiensi memori
        $memberIds = \App\Models\Member::pluck('id');

        DB::transaction(function () use ($memberIds, $bulan, $tahun, $nominal) {
            foreach ($memberIds as $id) {
                Contribution::firstOrCreate(
                    ['member_id' => $id, 'month' => $bulan, 'year' => $tahun],
                    ['amount' => $nominal, 'status' => 'UNPAID']
                );
            }
        });

        return redirect()->back()->with('success', "Tagihan periode $bulan $tahun berhasil dibuat.");
    }

    public function printInvoice($id)
    {
        $contribution = Contribution::with('member')->findOrFail($id);

        // Nama file PDF yang akan didownload
        $fileName = 'Invoice-' . $contribution->member->name . '-' . $contribution->month . '.pdf';

        // Memanggil view khusus untuk layout PDF
        $pdf = Pdf::loadView('admin.contributions.invoice_pdf', compact('contribution'));

        return $pdf->stream($fileName); // .stream agar terbuka di tab baru, .download untuk langsung unduh
    }
}
