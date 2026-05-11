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
            <a href="/admin/dashboard"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition group {{ request()->is('admin/dashboard') ? 'bg-emerald-800 text-white font-semibold' : 'text-emerald-100/70 hover:text-white hover:bg-emerald-800/50' }}">
                <svg class="w-5 h-5 {{ request()->is('admin/dashboard') ? 'text-emerald-400' : 'text-emerald-500 group-hover:text-emerald-400' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                <span class="text-sm">Dashboard</span>
            </a>

            <a href="/admin/anggota"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition group {{ request()->is('admin/anggota*') ? 'bg-emerald-800 text-white font-semibold' : 'text-emerald-100/70 hover:text-white hover:bg-emerald-800/50' }}">
                <svg class="w-5 h-5 {{ request()->is('admin/anggota*') ? 'text-emerald-400' : 'text-emerald-500 group-hover:text-emerald-400' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
                <span class="text-sm">Data Anggota</span>
            </a>

            <a href="{{ route('admin.contributions.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition group {{ request()->routeIs('admin.contributions.*') ? 'bg-emerald-800 text-white font-semibold' : 'text-emerald-100/70 hover:text-white hover:bg-emerald-800/50' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.contributions.*') ? 'text-emerald-400' : 'text-emerald-500 group-hover:text-emerald-400' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                    </path>
                </svg>
                <span class="text-sm">Iuran</span>
            </a>

            <hr class="my-4 border-white/50">

            <div class="mt-auto border-gray-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-3 w-full px-4 py-3 text-sm font-bold text-rose-600 hover:bg-rose-50 rounded-xl transition-all group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-rose-500 group-hover:scale-110 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </nav>
    </div>
</aside>
