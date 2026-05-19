<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STT Dharma Satya Mandala - Member</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-slate-50 font-sans antialiased pb-24">

    <header class="bg-white border-b border-slate-100 sticky top-0 z-40 px-4 py-3">
        <div class="max-w-md mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div>
                    <img src="{{ asset('img/logo-stt.jpeg') }}"
                        class="w-10 h-10 bg-emerald-800 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-sm">
                </div>
                <div>
                    <h1 class="text-sm font-bold text-slate-800 leading-none">STT DHARMA</h1>
                    <span class="text-[10px] font-semibold text-emerald-600 tracking-wider">SATYA MANDALA</span>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-md mx-auto px-4 py-6">
        @yield('content')
    </main>

    <nav
        class="fixed bottom-0 left-0 right-0 bg-white border-t border-slate-100 shadow-[0_-4px_10px_rgba(0,0,0,0.03)] z-40">
        <div class="max-w-md mx-auto flex justify-around items-center py-2.5">
            <a href="{{ route('member.dashboard') }}"
                class="flex flex-col items-center gap-1 {{ Route::is('member.dashboard') ? 'text-emerald-600' : 'text-slate-400 hover:text-slate-600' }}">
                <i data-lucide="home" class="w-5 h-5"></i>
                <span class="text-[10px] font-medium">Beranda</span>
            </a>

            <a href="{{ route('member.history') }}"
                class="flex flex-col items-center gap-1 {{ Route::is('member.history') ? 'text-emerald-600' : 'text-slate-400 hover:text-slate-600' }}">
                <i data-lucide="receipt" class="w-5 h-5"></i>
                <span class="text-[10px] font-medium">Riwayat</span>
            </a>

            <a href="{{ route('member.settings') }}"
                class="flex flex-col items-center gap-1 {{ Route::is('member.settings') ? 'text-emerald-600' : 'text-slate-400 hover:text-slate-600' }}">
                <i data-lucide="user" class="w-5 h-5"></i>
                <span class="text-[10px] font-medium">Akun</span>
            </a>
        </div>
    </nav>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
