@extends('layouts.member')

@section('content')
    <div class="space-y-6">

        <div>
            <h2 class="text-xl font-extrabold text-slate-800">Riwayat Iuran</h2>
            <p class="text-xs text-slate-500 mt-1">Daftar pembayaran iuran bulanan Anda</p>
        </div>

        <div class="space-y-3">
            @if (isset($historiIuran) && $historiIuran->count() > 0)
                @foreach ($historiIuran as $iuran)
                    <div class="bg-white border border-slate-100 p-4 rounded-xl shadow-sm flex items-center justify-between">
                        <div class="space-y-1">
                            <h4 class="text-xs font-extrabold text-slate-800">Iuran {{ $iuran->month }} {{ $iuran->year }}
                            </h4>
                            <p class="text-[11px] text-slate-500">Nominal: <strong class="text-slate-700">Rp
                                    {{ number_format($iuran->amount, 0, ',', '.') }}</strong></p>
                            @if ($iuran->status === 'PAID')
                                <p class="text-[9px] text-emerald-600 flex items-center gap-1">
                                    <i data-lucide="check-circle" class="w-3 h-3"></i> Terverifikasi Sistem
                                </p>
                            @else
                                <p class="text-[9px] text-rose-500 flex items-center gap-1">
                                    <i data-lucide="alert-circle" class="w-3 h-3"></i> Menunggu Pembayaran
                                </p>
                            @endif
                        </div>

                        <div>
                            @if ($iuran->status === 'PAID')
                                <span
                                    class="px-2.5 py-1 text-[10px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-full">
                                    Lunas
                                </span>
                            @else
                                <span
                                    class="px-2.5 py-1 text-[10px] font-bold text-rose-700 bg-rose-50 border border-rose-200 rounded-full">
                                    Belum Lunas
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white border border-slate-100 p-4 rounded-xl shadow-sm flex items-center justify-between">
                    <div class="space-y-1">
                        <h4 class="text-xs font-extrabold text-slate-800">Iuran Mei 2026</h4>
                        <p class="text-[11px] text-slate-500">Nominal: <strong class="text-slate-700">Rp 50.000</strong></p>
                        <p class="text-[9px] text-rose-500 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-3 h-3"></i> Belum Dibayar
                        </p>
                    </div>
                    <div>
                        <span
                            class="px-2.5 py-1 text-[10px] font-bold text-rose-700 bg-rose-50 border border-rose-200 rounded-full">
                            Belum Lunas
                        </span>
                    </div>
                </div>

                <div
                    class="bg-white border border-slate-100 p-4 rounded-xl shadow-sm flex items-center justify-between opacity-85">
                    <div class="space-y-1">
                        <h4 class="text-xs font-extrabold text-slate-800">Iuran April 2026</h4>
                        <p class="text-[11px] text-slate-500">Nominal: <strong class="text-slate-700">Rp 50.000</strong></p>
                        <p class="text-[9px] text-emerald-600 flex items-center gap-1">
                            <i data-lucide="check-circle" class="w-3 h-3"></i> Dibayar pada 05 Apr 2026
                        </p>
                    </div>
                    <div>
                        <span
                            class="px-2.5 py-1 text-[10px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-full">
                            Lunas
                        </span>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
