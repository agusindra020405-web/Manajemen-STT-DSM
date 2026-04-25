<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STT DSM - Manajemen</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    @php
        // Daftar tahun yang memiliki foto ogoh-ogoh (melewati 2020, 2021, 2022)
        $daftarTahun = [2026, 2025, 2024, 2023, 2019, 2018, 2017, 2016, 2015, 2014];
    @endphp
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Animasi Marquee Bergerak ke Kiri */
        @keyframes marquee-left {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-marquee-left {
            display: flex;
            width: max-content;
            animation: marquee-left 30s linear infinite;
        }

        /* Berhenti saat di-hover */
        .marquee-container:hover .animate-marquee-left {
            animation-play-state: paused;
        }
    </style>
</head>

<body class="bg-gray-50">

    <nav id="main-navbar" class="fixed w-full top-0 z-50 transition-all duration-300 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between h-20">

                <div class="flex items-center gap-3">
                    <div
                        class="w-12 h-12 flex items-center justify-center overflow-hidden rounded-full border border-white/20 shadow-sm">
                        <img src="{{ asset('img/logo-stt.jpeg') }}" alt="Logo STT" class="w-full h-full object-cover">
                    </div>
                    <span id="nav-title" class="text-xl font-bold text-white transition-colors duration-300">
                        STT Dharma Satya Mandala
                    </span>
                </div>

                <div id="nav-links" class="hidden md:flex items-center space-x-8">
                    <a href="#"
                        class="nav-item text-white hover:text-emerald-400 font-semibold transition">Home</a>
                    <a href="#" class="nav-item text-white/80 hover:text-emerald-400 transition">Galeri</a>
                    <a href="#" class="nav-item text-white/80 hover:text-emerald-400 transition">Tentang</a>
                    <a href="{{ route('login') }}"
                        class="bg-emerald-700 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-emerald-800 transition shadow-lg shadow-emerald-900/20">
                        Login
                    </a>
                </div>

                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button"
                        class="text-white focus:outline-none transition-colors duration-300">
                        <svg id="hamburger-icon" class="w-8 h-8" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg id="close-icon" class="w-8 h-8 hidden" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu"
            class="hidden md:hidden absolute left-0 w-full bg-white border-t border-gray-100 shadow-xl overflow-hidden transition-all duration-300">
            <div class="px-6 pt-4 pb-8 space-y-3">
                <a href="#"
                    class="block px-4 py-3 text-base font-semibold text-emerald-600 bg-emerald-50 rounded-xl">Home</a>
                <a href="#"
                    class="block px-4 py-3 text-base font-medium text-gray-600 hover:text-emerald-600 hover:bg-gray-50 rounded-xl transition">Galeri</a>
                <a href="#"
                    class="block px-4 py-3 text-base font-medium text-gray-600 hover:text-emerald-600 hover:bg-gray-50 rounded-xl transition">Tentang</a>
                <a href="#"
                    class="block px-4 py-3 text-base font-medium text-gray-600 hover:text-emerald-600 hover:bg-gray-50 rounded-xl transition">Login</a>
                <div class="pt-4 border-t border-gray-100">
                    <a href="#"
                        class="block w-full text-center bg-emerald-700 text-white px-6 py-3.5 rounded-xl font-bold shadow-md">
                        Register Sekarang
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <main class="relative min-h-screen flex items-center overflow-hidden bg-slate-950">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/background-hero.jpeg') }}" alt="Latar STT Dharma Satya Mandala"
                class="w-full h-full object-cover object-top transition-transform duration-700">

            <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-transparent to-[#0f172a]">
            </div>
        </div>

        <div
            class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white pt-32 pb-20 flex flex-col items-start justify-start">

            <div class="text-left">
                <h1 class="text-5xl md:text-7xl font-bold leading-tight max-w-3xl drop-shadow-2xl">
                    Seka Teruna Teruni<br>
                    <span class="text-emerald-400">Dharma Satya Mandala</span>
                </h1>

                <p class="mt-8 text-lg text-emerald-50/90 max-w-xl leading-relaxed drop-shadow-md">
                    Seka Teruna-Teruni Dharma Satya Mandala: Bergerak bersama dalam harmoni, menjaga budaya, dan
                    membangun masa depan desa.
                </p>
            </div>

        </div>
    </main>

    <section class="py-20 bg-slate-900 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 text-center">
                <h2 class="text-3xl font-bold text-white uppercase tracking-widest">Galeri Kegiatan Tahunan</h2>
                <div class="h-1 w-24 bg-emerald-500 mt-2 mx-auto"></div>
            </div>

            <div class="space-y-16">
                <div class="flex flex-col md:flex-row items-center gap-18">
                    <div class="w-full md:w-1/2 overflow-hidden rounded-2xl shadow-2xl bg-black">
                        <video src="{{ asset('videos/17agustus.mp4') }}"
                            class="w-full h-80 object-cover hover:scale-105 transition duration-500" autoplay loop muted
                            playsinline>
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="w-full md:w-1/2">
                        <span class="text-emerald-400 font-bold tracking-widest text-sm uppercase">Event Nasional</span>
                        <h3 class="text-3xl font-bold text-white mt-2">Perayaan Kemerdekaan RI</h3>
                        <p class="text-gray-400 mt-4 leading-relaxed">
                            Perayaan HUT RI di Lingkungan Banjar Bhuana Asri dimeriahkan dengan berbagai perlombaan, dan
                            jalan santai untuk mempererat rasa persaudaraan dan solidaritas antar warga dan pemuda.
                        </p>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row-reverse items-center gap-10">
                    <div class="w-full md:w-1/2 overflow-hidden rounded-2xl shadow-2xl bg-black">
                        <video src="{{ asset('videos/hut-stt.mp4') }}"
                            class="w-full h-80 object-cover hover:scale-105 transition duration-500" autoplay loop muted
                            playsinline>
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="w-full md:w-1/2">
                        <span class="text-purple-400 font-bold text-sm uppercase">Anniversary</span>
                        <h3 class="text-3xl font-bold text-white mt-2">HUT STT Dharma Satya Mandala</h3>
                        <p class="text-gray-400 mt-4 leading-relaxed">
                            Momen perayaan HUT STT Dharma Satya Mandala.
                            Dirayakan dengan kegiatan makan-makan, persembahan seni tari, dan malam keakraban seluruh
                            anggota STT
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-[#0f172a] px-6">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-white text-center md:text-left">Arsip Ogoh-ogoh</h2>
                <div class="h-1 w-20 bg-emerald-500 mt-2 mx-auto md:mx-0"></div>
                <p class="text-gray-400 mt-4 text-center md:text-left">Perjalanan kreativitas ogoh-ogoh STT kami dari
                    tahun ke tahun.</p>
            </div>

            <div class="marquee-container overflow-hidden relative py-10">
                <div class="animate-marquee-left flex gap-6">

                    {{-- fungsi untuk menampilkan item agar tidak menulis kode yang sama dua kali --}}
                    @foreach ([1, 2] as $looping)
                        <div class="flex gap-6">
                            @foreach ($daftarTahun as $tahun)
                                <div
                                    class="relative overflow-hidden rounded-xl bg-slate-800 w-[300px] aspect-[3/4] flex-shrink-0 group">

                                    {{-- Nama file disesuaikan dengan isi folder img (ogoh-ogoh-2024.jpeg) --}}
                                    <img src="{{ asset('img/ogoh-ogoh-' . $tahun . '.jpeg') }}"
                                        alt="Ogoh-ogoh {{ $tahun }}"
                                        class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-110">

                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent opacity-80">
                                    </div>

                                    <div class="absolute bottom-0 p-6">
                                        <span class="text-emerald-400 font-mono text-sm">Arsip Karya</span>
                                        <h3 class="text-xl font-semibold text-white uppercase">Ogoh-Ogoh
                                            {{ $tahun }}</h3>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

    <footer class="bg-black text-white pt-16 pb-8 border-t border-emerald-900/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('img/logo-stt.jpeg') }}" alt="Logo" class="w-12 h-12 rounded-full">
                        <span class="text-xl font-bold tracking-tighter">STT DHARMA SATYA MANDALA</span>
                    </div>
                    <p class="text-gray-500 max-w-sm leading-relaxed">
                        Wadah kreativitas dan inovasi pemuda pemudi dalam menjaga warisan budaya Bali dan memajukan desa
                        di era digital.
                    </p>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-6">Tautan</h4>
                    <ul class="space-y-4 text-gray-500">
                        <li><a href="#" class="hover:text-emerald-400 transition">Beranda</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition">Galeri Ogoh-ogoh</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition">Struktur Organisasi</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-6">Ikuti Kami</h4>
                    <div class="flex gap-4">
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-emerald-600 transition text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-emerald-600 transition text-white">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-emerald-600 transition text-white">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-900 text-center text-gray-600 text-sm">
                <p>&copy; 2026 STT Dharma Satya Mandala. All rights reserved.</p>
            </div>
        </div>
    </footer>


    <script>
        const navbar = document.getElementById('main-navbar');
        const navTitle = document.getElementById('nav-title');
        const navLinks = document.querySelectorAll('.nav-item');
        const mobileMenuBtn = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        // 1. Fungsi Scroll (Transparan ke Solid)
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('bg-white', 'shadow-md', 'py-1');
                navbar.classList.remove('py-0', 'px-4', 'sm:px-6', 'lg:px-8');
                navTitle.classList.replace('text-white', 'text-gray-800');
                mobileMenuBtn.classList.replace('text-white', 'text-gray-800');

                navLinks.forEach(link => {
                    link.classList.replace('text-white', 'text-gray-600');
                    link.classList.replace('text-white/80', 'text-gray-600');
                });
            } else {
                navbar.classList.remove('bg-white', 'shadow-md', 'py-1');
                navbar.classList.add('px-4', 'sm:px-6', 'lg:px-8');
                navTitle.classList.replace('text-gray-800', 'text-white');
                mobileMenuBtn.classList.replace('text-gray-800', 'text-white');

                navLinks.forEach(link => {
                    link.classList.add('text-white');
                    link.classList.remove('text-gray-600');
                });
            }
        });

        // 2. Fungsi Toggle Mobile Menu
        mobileMenuBtn.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.toggle('hidden');
            hamburgerIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');

            // Jika menu dibuka saat posisi paling atas (transparan), 
            // background putih agar menu mobile terlihat jelas
            if (!isHidden && window.scrollY <= 50) {
                navbar.classList.add('bg-white');
            } else if (isHidden && window.scrollY <= 50) {
                navbar.classList.remove('bg-white');
            }
        });
    </script>

</body>

</html>
