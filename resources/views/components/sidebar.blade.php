<aside class="fixed left-0 top-0 h-screen w-64 bg-emerald-900 text-white shadow-xl z-50">
    <div class="p-6">
        <div class="flex items-center gap-3 mb-10 border-b border-emerald-800 pb-6">
            <img src="{{ asset('img/logo-stt.jpeg') }}"
                class="w-12 h-12 rounded-full border-2 border-emerald-500/50 object-cover">
            <div class="flex flex-col">
                <span class="font-bold text-sm tracking-tight leading-none">STT DHARMA</span>
                <span class="font-bold text-sm tracking-tight text-emerald-400">SATYA MANDALA</span>
            </div>
        </div>

        <nav class="space-y-1">
            <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 bg-emerald-800 rounded-xl transition group">
                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                <span class="font-semibold text-sm">Dashboard</span>
            </a>

            <a href="/admin/anggota"
                class="flex items-center gap-3 px-4 py-3 text-emerald-100/70 hover:text-white hover:bg-emerald-800/50 rounded-xl transition group">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
                <span class="text-sm">Data Anggota</span>
            </a>

            <a href="{{ route('contributions.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('iuran.*') ? 'bg-emerald-500/10 text-emerald-600 font-bold' : 'text-gray-400 hover:text-gray-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                    </path>
                </svg>
                <span>Iuran</span>
            </a>
        </nav>
    </div>
</aside>
