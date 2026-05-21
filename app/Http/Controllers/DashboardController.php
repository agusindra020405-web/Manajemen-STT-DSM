<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Contribution;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
        //Hubungkan ke user yang sedang login
        $member = Auth::user();

        //Set total tunggakan
        $totalTunggakan = 50000; // Contoh: Tunggakan Rp 50.000

        //untuk mengambil data terakhir dari database
        $latestAnnouncement = Announcement::latest()->first();

        //jika belum ada informasi
        $infoPenting = $latestAnnouncement ? $latestAnnouncement->content : "Belum ada informasi terbaru dari pengurus.";

        return view('member.dashboard', compact('member', 'totalTunggakan', 'infoPenting'));
    }

    /**
     * Tampilan Histori Pembayaran Anggota
     */


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

    public function payXendit(Request $request)
    {
        $user = Auth::user();
        $amount = 50000;
        $referenceId = 'STTDSM-' . time() . '-' . $user->id; // Format ID unik transaksi

        //Ambil konfigurasi dari config/services.php
        $baseUrl = rtrim((string) config('services.xendit.base_url', 'https://api.xendit.co'), '/');
        $secretKey = (string) config('services.xendit.secret_key');

        //Menyusun parameter URL balik dengan reference_id
        $successUrl = config('services.xendit.success_url') . (str_contains(config('services.xendit.success_url'), '?') ? '&' : '?') . 'reference_id=' . urlencode($referenceId);
        $failureUrl = config('services.xendit.failure_url') . (str_contains(config('services.xendit.failure_url'), '?') ? '&' : '?') . 'reference_id=' . urlencode($referenceId);

        //Payload 
        $payload = [
            'external_id'           => $referenceId,
            'amount'                => $amount,
            'description'           => 'Pembayaran Iuran STT Dharma Satya Mandala - ' . $user->name,
            'invoice_duration'      => 86400,
            'currency'              => 'IDR',
            'success_redirect_url' => $successUrl,
            'failure_redirect_url' => $failureUrl,
            'should_send_email'    => false,
            'customer' => array_filter([
                'given_names'   => $user->name,
                'email'         => $user->email ?? null,
                'mobile_number' => $user->phone ?? null,
            ]),
            'items' => [
                [
                    'name'     => 'Iuran Anggota STT DSM',
                    'quantity' => 1,
                    'price'    => $amount,
                ]
            ],
        ];

        try {
            // Request POST ke Xendit Invoice V2
            $response = Http::timeout(30)
                ->withBasicAuth($secretKey, '')
                ->withHeaders(['Accept' => 'application/json'])
                ->post($baseUrl . '/v2/invoices', $payload);

            if ($response->successful()) {
                $invoice = $response->json();

                $currentMonth = strtolower(Carbon::now()->format('F'));
                // Simpan ke database
                Contribution::updateOrCreate(
                    [
                        'member_id' => $user->member->id,
                        'month'     => $currentMonth,
                        'year'      => Carbon::now()->format('Y'),
                    ],
                    [
                        'reference_id'  => $referenceId,
                        'amount'        => $amount,
                        'status'        => 'UNPAID',
                        'payment_method' => 'XENDIT',
                    ]
                );

                return redirect()->away($invoice['invoice_url']);
            }

            return back()->with('error', 'Gagal membuat invoice ke Xendit: ' . $response->body());
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal terhubung ke layanan Xendit: ' . $e->getMessage());
        }
    }


    /**
     * Tampilan Riwayat Pembayaran + Mekanisme Status Polling Otomatis
     */
    public function memberHistory(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil member_id berdasarkan relasi user -> member
        $memberId = Member::where('user_id', $user->id)->value('id');

        // Tahun sekarang untuk menampilkan histori tahun berjalan
        $year = Carbon::now()->format('Y');

        // Ambil parameter reference_id dari URL jika Xendit mengembalikan callback
        $referenceId = $request->string('reference_id')->toString();

        $paymentStatus = null;
        $paymentMessage = null;



        // Ambil parameter reference_id dari URL jika Xendit mengembalikan callback
        $referenceId = $request->string('reference_id')->toString();

        $paymentStatus = null;
        $paymentMessage = null;

        if ($referenceId !== '') {
            // Ambil konfigurasi Xendit dari services.php
            $baseUrl = rtrim((string) config('services.xendit.base_url', 'https://api.xendit.co'), '/');
            $secretKey = (string) config('services.xendit.secret_key');

            // Cek status invoice Xendit berdasarkan external_id
            $response = Http::timeout(30)
                ->withBasicAuth($secretKey, '')
                ->withHeaders(['Accept' => 'application/json'])
                ->get($baseUrl . '/v2/invoices?external_id=' . urlencode($referenceId));

            if ($response->successful() && !empty($response->json())) {
                $invoices = $response->json();
                $invoiceData = $invoices[0] ?? null;

                if ($invoiceData) {
                    $status = strtoupper($invoiceData['status']);

                    if (in_array($status, ['PAID', 'SETTLED'])) {
                        $paymentStatus = 'paid';
                        $paymentMessage = 'Status pembayaran: ' . $status;

                        //Cari iuran bulan berjalan yang UNPAID, lalu LUNASKAN!
                        // pembayaran Xendit saat ini untuk iuran bulan berjalan dulu (misal: 'May')
                        $currentEnglishMonth = strtolower(Carbon::now()->format('F'));

                        Contribution::updateOrCreate(
                            [
                                'member_id' => $memberId,
                                'year'      => $year,
                                'month'     => $currentEnglishMonth,
                            ],
                            [
                                'amount'    => 50000,
                                'status'    => 'PAID',
                                'created_at' => now()
                            ]
                        );
                    } else {
                        $paymentStatus = 'pending';
                        $paymentMessage = 'Status pembayaran: ' . $status;
                    }
                } else {
                    $paymentStatus = 'not_found';
                    $paymentMessage = 'Invoice tidak ditemukan.';
                }
            } else {
                $paymentStatus = 'error';
                $paymentMessage = 'Gagal cek status pembayaran: ' . $response->body();
            }
        }


        //Setelah database terupdate, baru ambil data kontribusi untuk view
        $existingContributions = Contribution::where('member_id', $memberId)
            ->where('year', $year)
            ->get()
            ->keyBy(function ($item) {
                return strtolower($item->month);
            });

        $defaultAmount = 50000;

        // Peta bulan Inggris ke Indonesia untuk tampilan
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

        // Buat daftar bulan berdasarkan mapping
        foreach ($monthMap as $englishMonth => $indonesianMonth) {
            if ($existingContributions->has($englishMonth)) {
                $dbData = $existingContributions->get($englishMonth);

                // Jika sudah ada data kontribusi, gunakan data tersebut
                $contributions[] = (object)[
                    'month'   => $indonesianMonth,
                    'year'    => $dbData->year,
                    'amount'  => $dbData->amount,
                    'status'  => $dbData->status,
                    'paid_at' => $dbData->created_at ? $dbData->created_at->toDateTimeString() : null,
                ];
            } else {
                // Jika belum ada kontribusi untuk bulan ini, tampilkan default UNPAID
                $contributions[] = (object)[
                    'month'   => $indonesianMonth,
                    'year'    => $year,
                    'amount'  => $defaultAmount,
                    'status'  => 'UNPAID',
                    'paid_at' => null,
                ];
            }
        }

        // Kirim data ke view member.history
        return view('member.history', compact(
            'contributions',
            'paymentStatus',
            'paymentMessage',
            'referenceId'
        ));
    }

    public function paymentSuccess(Request $request)
    {
        // Tangkap reference_id dari URL
        $referenceId = $request->query('reference_id');

        if (!$referenceId) {
            return redirect()->route('member.history')->with('error', 'Referensi transaksi tidak valid.');
        }

        // Cari data iuran di database berdasarkan reference_id 
        $contribution = Contribution::where('reference_id', $referenceId)->first();

        if ($contribution) {
            // Jika data ditemukan, ubah statusnya menjadi PAID
            $contribution->update([
                'status' => 'PAID',
                'created_at' => now()
            ]);

            return redirect()->route('member.history')->with('success', 'Pembayaran iuran bulan ini berhasil diproses dan LUNAS!');
        }

        return redirect()->route('member.history')->with('error', 'Data transaksi tidak ditemukan di sistem.');
    }
}
