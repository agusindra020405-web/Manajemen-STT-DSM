<x-app-layout>
    <main class="relative min-h-screen flex items-center justify-center overflow-hidden bg-slate-950">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/background-hero.jpeg') }}" class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-slate-950/90 to-slate-950"></div>
        </div>

        <div class="relative z-10 w-full max-w-md px-6">
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-8 rounded-3xl shadow-2xl">
                <div class="text-center mb-10">
                    <img src="{{ asset('img/logo-stt.jpeg') }}" alt="Logo"
                        class="w-20 h-20 mx-auto rounded-full border-2 border-emerald-500/50 mb-4">
                    <h2 class="text-3xl font-bold text-white">Selamat Datang</h2>
                    <p class="text-slate-400 mt-2">Silahkan masuk ke akun Anda</p>
                </div>

                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-emerald-400 mb-2">Username / Email</label>
                        <input type="text" name="identity" required
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-emerald-500/50 transition outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-emerald-400 mb-2">Password</label>
                        <input type="password" name="password" required
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-emerald-500/50 transition outline-none">
                    </div>

                    <button type="submit"
                        class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-4 rounded-xl transition duration-200">
                        Masuk Sekarang
                    </button>
                </form>
            </div>
        </div>
    </main>
</x-app-layout>
