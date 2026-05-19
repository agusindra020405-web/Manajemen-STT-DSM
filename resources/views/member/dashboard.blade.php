@extends('layouts.member')

@section('content')
    <div class="space-y-6">

        <div>
            <h2 class="text-xl font-extrabold text-slate-800">
                Halo, {{ auth()->user()->name }}
            </h2>
            <p class="text-xs text-slate-500 mt-1">Anggota STT Dharma Satya Mandala</p>
        </div>

        <div
            class="bg-gradient-to-br from-emerald-800 to-emerald-950 rounded-2xl p-6 text-white shadow-xl shadow-emerald-900/10 relative overflow-hidden">
            <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-white/5 rounded-full"></div>
            <div class="absolute right-12 -top-12 w-24 h-24 bg-white/5 rounded-full"></div>

            <p class="text-xs text-emerald-200/90 font-medium tracking-wide">Total tunggakan </p>
            <p class="text-3xl font-extrabold mt-1">Rp {{ number_format($totalTunggakan, 0, ',', '.') }}</p>

            <form action="{{ route('member.payXendit') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full bg-white text-emerald-900 font-bold py-3 px-4 rounded-xl mt-5 shadow-md hover:bg-emerald-50 transition active:scale-95 text-sm flex items-center justify-center gap-2">
                    Bayar Sekarang
                </button>
            </form>

            <p class="text-[10px] text-emerald-200/70 text-center mt-3 flex items-center justify-center gap-1">
                <i data-lucide="shield-check" class="w-3.5 h-3.5"></i> Aman, cepat, dan mudah
            </p>
        </div>

        <div class="grid grid-cols-3 gap-3 justify-center max-w-sm mx-auto">
            <a href="{{ route('member.history') }}"
                class="bg-white border border-slate-100 p-3 rounded-xl flex flex-col items-center justify-center gap-1.5 shadow-sm active:bg-slate-50">
                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center">
                    <i data-lucide="history" class="w-5 h-5"></i>
                </div>
                <span class="text-[10px] font-bold text-slate-700 text-center leading-tight">Riwayat</span>
            </a>

            <a href="#"
                class="bg-white border border-slate-100 p-3 rounded-xl flex flex-col items-center justify-center gap-1.5 shadow-sm active:bg-slate-50">
                <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-lg flex items-center justify-center">
                    <i data-lucide="wallet" class="w-5 h-5"></i>
                </div>
                <span class="text-[10px] font-bold text-slate-700 text-center leading-tight">Pembayaran</span>
            </a>

            <a href="{{ route('member.settings') }}"
                class="bg-white border border-slate-100 p-3 rounded-xl flex flex-col items-center justify-center gap-1.5 shadow-sm active:bg-slate-50">
                <div class="w-10 h-10 bg-rose-50 text-rose-600 rounded-lg flex items-center justify-center">
                    <i data-lucide="user" class="w-5 h-5"></i>
                </div>
                <span class="text-[10px] font-bold text-slate-700 text-center leading-tight">Akun Saya</span>
            </a>
        </div>

        <div class="bg-white border border-slate-100 rounded-2xl p-4 shadow-sm">
            <div class="flex items-start gap-3">
                <div class="p-2 bg-emerald-50 text-emerald-600 rounded-xl">
                    <i data-lucide="megaphone" class="w-5 h-5"></i>
                </div>
                <div class="flex-1">
                    <h4 class="text-xs font-bold text-slate-800">Informasi Penting</h4>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        {{ $infoPenting }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
