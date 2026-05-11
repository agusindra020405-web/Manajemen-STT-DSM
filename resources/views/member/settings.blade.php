@extends('layouts.member')

@section('content')
<div class="space-y-6">
    
    <div>
        <h2 class="text-xl font-extrabold text-slate-800">Profil Saya</h2>
        <p class="text-xs text-slate-500 mt-1">Kelola keamanan akun Anda</p>
    </div>

    <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-sm text-center flex flex-col items-center">
        <div class="w-20 h-20 bg-emerald-100 border-4 border-emerald-50 text-emerald-800 rounded-full flex items-center justify-center font-black text-2xl shadow-sm">
            {{ isset($member->name) ? strtoupper(substr($member->name, 0, 1)) : strtoupper(substr($user->name ?? 'M', 0, 1)) }}
        </div>
        
        <h3 class="text-base font-extrabold text-slate-800 mt-3">{{ $member->name ?? $user->name ?? 'Nama Tidak Terdaftar' }}</h3>
        
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-3.5 rounded-xl text-xs font-semibold flex items-center gap-2">
            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-800 p-3.5 rounded-xl text-xs font-semibold space-y-1">
            <div class="flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600"></i>
                <span>Terjadi kesalahan:</span>
            </div>
            <ul class="list-disc list-inside pl-1 text-[11px] text-rose-700 font-normal">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-sm space-y-4">
        <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
            <i data-lucide="lock" class="w-4 h-4 text-emerald-600"></i>
            <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Keamanan & Ubah Password</h4>
        </div>

        <form action="{{ route('member.password.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="space-y-1.5">
                <label for="current_password" class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Password Lama</label>
                <div class="relative">
                    <input type="password" name="current_password" id="current_password" required
                        class="w-full bg-slate-50 border border-slate-100 rounded-xl px-3.5 py-3 text-xs focus:bg-white focus:ring-2 focus:ring-emerald-500/10 focus:border-emerald-500 transition outline-none"
                        placeholder="Masukkan password saat ini">
                </div>
            </div>

            <div class="space-y-1.5">
                <label for="password" class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Password Baru</label>
                <div class="relative">
                    <input type="password" name="password" id="password" required
                        class="w-full bg-slate-50 border border-slate-100 rounded-xl px-3.5 py-3 text-xs focus:bg-white focus:ring-2 focus:ring-emerald-500/10 focus:border-emerald-500 transition outline-none"
                        placeholder="Minimal 8 karakter">
                </div>
            </div>

            <div class="space-y-1.5">
                <label for="password_confirmation" class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Konfirmasi Password Baru</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full bg-slate-50 border border-slate-100 rounded-xl px-3.5 py-3 text-xs focus:bg-white focus:ring-2 focus:ring-emerald-500/10 focus:border-emerald-500 transition outline-none"
                        placeholder="Ulangi password baru">
                </div>
            </div>

            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-xl transition active:scale-95 text-xs flex items-center justify-center gap-2 shadow-md shadow-emerald-600/10 mt-2">
                <i data-lucide="key-round" class="w-4 h-4"></i>
                Perbarui Password
            </button>
        </form>
    </div>

    <div>
        <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar?')">
            @csrf
            <button type="submit" class="w-full bg-rose-50 hover:bg-rose-100 border border-rose-100 text-rose-600 font-bold py-3 px-4 rounded-xl transition active:scale-95 text-xs flex items-center justify-center gap-2">
                <i data-lucide="log-out" class="w-4 h-4"></i>
                Keluar dari Akun
            </button>
        </form>
    </div>

</div>
@endsection