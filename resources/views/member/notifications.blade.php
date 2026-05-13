@extends('layouts.member')

@section('content')
    <div class="space-y-6">

        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-extrabold text-slate-800">Notifikasi</h2>
                <p class="text-xs text-slate-500 mt-1">Informasi dan pembaruan aktivitas akun Anda</p>
            </div>
        </div>

        <div class="space-y-3">

            <div
                class="bg-white border-l-4 border-emerald-500 border-y border-r border-slate-100 p-4 rounded-r-2xl shadow-sm flex items-start gap-3 relative">
                <div class="absolute top-4 right-4 w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>

                <div class="p-2 bg-emerald-50 text-emerald-600 rounded-xl mt-0.5">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                </div>
                <div class="flex-1 pr-4">
                    <h4 class="text-xs font-extrabold text-slate-800">Pembayaran Berhasil Terverifikasi</h4>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Pembayaran iuran bulan **April 2026** sebesar **Rp 50.000** telah diverifikasi oleh admin. Terima
                        kasih atas partisipasi Anda!
                    </p>
                </div>
            </div>

            <div
                class="bg-white border-l-4 border-amber-500 border-y border-r border-slate-100 p-4 rounded-r-2xl shadow-sm flex items-start gap-3 relative">
                <div class="absolute top-4 right-4 w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>

                <div class="p-2 bg-amber-50 text-amber-600 rounded-xl mt-0.5">
                    <i data-lucide="alert-circle" class="w-5 h-5"></i>
                </div>
                <div class="flex-1 pr-4">
                    <h4 class="text-xs font-extrabold text-slate-800">Tagihan Baru Bulan Mei 2026</h4>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Tagihan iuran bulan **Mei 2026** sebesar **Rp 50.000** sudah bisa di bayar. Silakan lakukan
                        pembayaran
                        sebelum akhir bulan.
                    </p>
                </div>
            </div>
        </div>

    </div>
@endsection
