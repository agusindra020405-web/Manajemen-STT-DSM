@extends('layouts.member')

@section('content')
    <div class="space-y-6">
        <div>
            <h2 class="text-xl font-extrabold text-slate-800">Status Iuran</h2>
            <p class="text-xs text-slate-500 mt-1">Daftar pembayaran iuran bulanan Anda tahun 2026</p>
        </div>

        {{-- Flex col-reverse untuk mengurutkan Januari dari paling bawah --}}
        <div class="flex flex-col-reverse space-y-reverse space-y-3">
            @foreach ($contributions as $item)
                @if ($item->status === 'LOCKED')
                    {{-- STATUS: BELUM AKTIF --}}
                    <div
                        class="bg-slate-50/80 border border-slate-100 p-4 rounded-xl shadow-sm flex items-center justify-between">
                        <div class="space-y-1">
                            <h4 class="text-xs font-extrabold text-slate-800">Iuran {{ $item->month }} 2026</h4>
                            <p class="text-[11px] text-slate-500">Nominal: <strong class="text-slate-700">Rp
                                    {{ $item->amount }}</strong></p>
                            <p class="text-[9px] text-slate-400 flex items-center gap-1">
                                Menunggu antrean bayar
                            </p>
                        </div>
                        <div>
                            {{-- Hanya lingkaran badge ini yang abu-abu --}}
                            <span
                                class="px-2.5 py-1 text-[10px] font-bold text-slate-500 bg-slate-100 border border-slate-200 rounded-full">
                                Belum Aktif
                            </span>
                        </div>
                    </div>
                @elseif($item->status === 'UNPAID')
                    {{-- STATUS: BELUM LUNAS --}}
                    <div
                        class="bg-white border border-slate-100 p-4 rounded-xl shadow-sm flex items-center justify-between">
                        <div class="space-y-1">
                            <h4 class="text-xs font-extrabold text-slate-800">Iuran {{ $item->month }} 2026</h4>
                            <p class="text-[11px] text-slate-500">Nominal: <strong class="text-slate-700">Rp
                                    {{ $item->amount }}</strong></p>
                            <p class="text-[9px] text-rose-500 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3 h-3"></i> Menunggu Pembayaran
                            </p>
                        </div>
                        <div>
                            <span
                                class="px-2.5 py-1 text-[10px] font-bold text-rose-700 bg-rose-50 border border-rose-200 rounded-full">
                                Belum Lunas
                            </span>
                        </div>
                    </div>
                @else
                    {{-- STATUS: LUNAS --}}
                    <div
                        class="bg-white border border-slate-100 p-4 rounded-xl shadow-sm flex items-center justify-between">
                        <div class="space-y-1">
                            <h4 class="text-xs font-extrabold text-slate-800">Iuran {{ $item->month }} 2026</h4>
                            <p class="text-[11px] text-slate-500">Nominal: <strong class="text-slate-700">Rp
                                    {{ $item->amount }}</strong></p>
                            <p class="text-[9px] text-emerald-600 flex items-center gap-1">
                                <i data-lucide="check-circle" class="w-3 h-3"></i> Terverifikasi Sistem
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
            @endforeach
        </div>
    </div>
@endsection
