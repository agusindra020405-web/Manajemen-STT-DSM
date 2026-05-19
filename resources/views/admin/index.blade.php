<x-app-layout>
    {{-- Halaman dashboard admin: membungkus seluruh konten dashboard di dalam layout aplikasi --}}
    <div class="max-w-7xl mx-auto space-y-8">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Dashboard</h1>
                <p class="text-sm text-slate-500 mt-1">Pantau jumlah anggota dan status iuran anggota STT.</p>
            </div>


            {{-- Area Kelola Informasi Penting oleh Admin --}}
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900">Kelola Informasi Penting (Dashboard Anggota)</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Teks di bawah ini akan langsung tampil di beranda anggota.</p>
                    </div>
                </div>

                @if (session('success'))
                    <div class="mb-3 p-3 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-xl">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.announcement.update') }}" method="POST" class="space-y-3">
                    @csrf
                    <div class="flex gap-3">
                        <input type="text" name="content" placeholder="Ketik informasi penting di sini..."
                            class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">

                        <button type="submit"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-5 py-2.5 rounded-xl transition whitespace-nowrap">
                            Perbarui Info
                        </button>
                    </div>
                    @error('content')
                        <span class="text-xs text-rose-600 font-medium pl-1">{{ $message }}</span>
                    @enderror
                </form>
            </div>


            {{-- Form filter bulan: memilih bulan akan mengirim request GET ke route admin.dashboard --}}
            <form action="{{ route('admin.dashboard') }}" method="GET" id="filterForm"
                class="flex items-center gap-3">
                <span class="text-sm text-slate-500 font-medium">Data untuk bulan:</span>
                <div class="relative">
                    <select name="bulan" onchange="document.getElementById('filterForm').submit()"
                        class="appearance-none bg-white border border-slate-200 text-slate-700 text-sm font-semibold rounded-xl pl-4 pr-10 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 cursor-pointer">
                        <option value="January" {{ $bulanSekarang == 'January' ? 'selected' : '' }}>Januari 2026
                        </option>
                        <option value="February" {{ $bulanSekarang == 'February' ? 'selected' : '' }}>Februari 2026
                        </option>
                        <option value="March" {{ $bulanSekarang == 'March' ? 'selected' : '' }}>Maret 2026</option>
                        <option value="April" {{ $bulanSekarang == 'April' ? 'selected' : '' }}>April 2026</option>
                        <option value="May" {{ $bulanSekarang == 'May' ? 'selected' : '' }}>Mei 2026</option>
                        <option value="June" {{ $bulanSekarang == 'June' ? 'selected' : '' }}>June 2026</option>
                        <option value="July" {{ $bulanSekarang == 'July' ? 'selected' : '' }}>July 2026</option>
                        <option value="August" {{ $bulanSekarang == 'August' ? 'selected' : '' }}>Agustus 2026</option>
                        <option value="September" {{ $bulanSekarang == 'September' ? 'selected' : '' }}>September 2026
                        </option>
                        <option value="October" {{ $bulanSekarang == 'October' ? 'selected' : '' }}>Oktober 2026
                        </option>
                        <option value="November" {{ $bulanSekarang == 'November' ? 'selected' : '' }}>November 2026
                        </option>
                        <option value="December" {{ $bulanSekarang == 'December' ? 'selected' : '' }}>Desember 2026
                        </option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
                <input type="hidden" name="tahun" value="2026">
            </form>
        </div>

        {{-- Ringkasan utama: total anggota, total kas, dan jumlah anggota lunas bulan ini --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div
                class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-5 transition hover:shadow-md">
                <div class="p-4 bg-emerald-50 text-emerald-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Anggota</p>
                    <h3 class="text-2xl font-extrabold text-slate-800 mt-1">{{ $totalAnggota }}</h3>
                    <span class="text-xs text-slate-400 font-medium">anggota terdaftar</span>
                </div>
            </div>

            <div
                class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-5 transition hover:shadow-md">
                <div class="p-4 bg-emerald-50 text-emerald-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Kas STT</p>
                    <h3 class="text-2xl font-extrabold text-slate-800 mt-1">Rp
                        {{ number_format($totalKas, 0, ',', '.') }}</h3>
                    <span class="text-xs text-slate-400 font-medium">total saldo kas</span>
                </div>
            </div>

            <div
                class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-5 transition hover:shadow-md">
                <div class="p-4 bg-emerald-50 text-emerald-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Anggota Lunas Bulan Ini
                    </p>
                    <h3 class="text-2xl font-extrabold text-slate-800 mt-1">
                        {{ $totalLunas }} <span class="text-sm font-normal text-slate-400">/
                            {{ $totalAnggota }}</span>
                    </h3>
                    <span class="text-xs text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded-full">
                        {{ $persenLunas }}% Terbayar
                    </span>
                </div>
            </div>
        </div>

        {{-- Detail persentase pembayaran dan daftar tunggakan terbaru untuk bulan yang dipilih --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <div
                class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm lg:col-span-5 flex flex-col justify-between">
                <div>
                    <h3 class="text-base font-bold text-slate-900 tracking-tight">Persentase Pembayaran
                        ({{ $bulanIndoStr }} 2026)</h3>
                </div>

                <div class="relative flex items-center justify-center py-6 h-52 group">
                    <svg class="w-44 h-44 transform -rotate-90 cursor-pointer overflow-visible">
                        <circle cx="88" cy="88" r="74" class="text-slate-100" stroke-width="14"
                            stroke="currentColor" fill="transparent" />

                        <circle id="progressLunas" cx="88" cy="88" r="74"
                            class="text-emerald-500 transition-all ease-out" stroke-width="14" stroke-dasharray="465"
                            stroke-dashoffset="465" stroke-linecap="round" stroke="currentColor"
                            fill="transparent" />

                        <circle id="progressBelumLunas" cx="88" cy="88" r="74"
                            class="text-rose-500 transition-all ease-out" stroke-width="14" stroke-dasharray="465"
                            stroke-dashoffset="465" stroke-linecap="round" stroke="currentColor"
                            fill="transparent" />
                    </svg>

                    <div class="absolute text-center pointer-events-none">
                        <span
                            class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ $persenLunas }}%</span>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Lunas</p>
                    </div>
                </div>

                <div class="space-y-2.5 bg-slate-50 p-4 rounded-xl">
                    <div class="flex justify-between items-center text-xs">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full"></span>
                            <span class="font-medium text-slate-600">Lunas</span>
                        </div>
                        <span class="font-bold text-slate-800">{{ $totalLunas }} Anggota
                            ({{ $persenLunas }}%)</span>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 bg-rose-500 rounded-full"></span>
                            <span class="font-medium text-slate-600">Belum Lunas</span>
                        </div>
                        <span class="font-bold text-slate-800">{{ $totalBelumLunas }} Anggota
                            ({{ $persenBelumLunas }}%)</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm lg:col-span-7 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-base font-bold text-slate-900 tracking-tight">Tunggakan Terbaru
                                ({{ $bulanIndoStr }})</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Daftar anggota yang belum menyelesaikan iuran
                                terakhir.</p>
                        </div>
                        <span class="p-2 bg-rose-50 text-rose-500 rounded-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-600">
                            <thead>
                                <tr
                                    class="text-[11px] uppercase tracking-wider text-slate-400 border-b border-slate-100">
                                    <th class="py-3 font-semibold">Nama Anggota</th>
                                    <th class="py-3 font-semibold">Bulan</th>
                                    <th class="py-3 font-semibold text-right">Jumlah</th>
                                    <th class="py-3 font-semibold text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($tunggakanTerbaru as $tunggakan)
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="py-3.5 font-semibold text-slate-800">{{ $tunggakan->name }}
                                        </td>
                                        <td class="py-3.5 text-slate-500">{{ $bulanIndoStr }} 2026</td>
                                        <td class="py-3.5 font-bold text-slate-700 text-right">Rp
                                            {{ number_format($tunggakan->amount, 0, ',', '.') }}</td>
                                        <td class="py-3.5 text-center">
                                            <span
                                                class="px-2.5 py-1 text-[10px] font-bold rounded-lg bg-rose-50 text-rose-600">
                                                Menunggak
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"
                                            class="py-6 text-center text-sm text-slate-400 font-medium">
                                            Tidak ada tunggakan pembayaran untuk periode ini. Semua iuran lunas! 👍
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="text-center mt-5 border-t border-slate-50 pt-4">
                    <a href="{{ route('admin.contributions.index', ['status' => 'UNPAID', 'bulan' => $bulanSekarang]) }}"
                        class="text-xs font-bold text-emerald-600 hover:text-emerald-700 inline-flex items-center gap-1.5 transition">
                        Lihat semua tunggakan
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- Script untuk animasi lingkaran progress pembayaran --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const circleLunas = document.getElementById('progressLunas');
        const circleBelumLunas = document.getElementById('progressBelumLunas');
        const chartArea = circleLunas.closest('.group');

        const totalKeliling = 465;

        // Data Persentase Dinamis yang dikirimkan oleh Controller PHP ke JS
        const persenLunas = {{ $persenLunas }};
        const persenBelumLunas = {{ $persenBelumLunas }};

        const durasiLunas = (persenLunas / 100) * 1000;
        const durasiBelumLunas = (persenBelumLunas / 100) * 1000;

        circleLunas.style.transitionDuration = `${durasiLunas}ms`;
        circleBelumLunas.style.transitionDuration = `${durasiBelumLunas}ms`;

        function jalankanAnimasi(targetLunas, targetBelumLunas) {
            circleLunas.style.transitionProperty = 'none';
            circleBelumLunas.style.transitionProperty = 'none';
            circleLunas.style.strokeDashoffset = totalKeliling;
            circleBelumLunas.style.strokeDashoffset = totalKeliling;

            const derajatMulaiMerah = (targetLunas / 100) * 360;
            circleBelumLunas.style.transformOrigin = '88px 88px';
            circleBelumLunas.style.transform = `rotate(${derajatMulaiMerah}deg)`;

            setTimeout(() => {
                circleLunas.style.transitionProperty = 'all';
                circleBelumLunas.style.transitionProperty = 'all';

                const offsetLunas = totalKeliling - (totalKeliling * targetLunas) / 100;
                circleLunas.style.strokeDashoffset = offsetLunas;

                setTimeout(() => {
                    const offsetBelumLunas = totalKeliling - (totalKeliling *
                        targetBelumLunas) / 100;
                    circleBelumLunas.style.strokeDashoffset = offsetBelumLunas;
                }, durasiLunas);

            }, 50);
        }

        setTimeout(() => {
            jalankanAnimasi(persenLunas, persenBelumLunas);
        }, 300);

        chartArea.addEventListener('mouseenter', () => {
            jalankanAnimasi(persenLunas, persenBelumLunas);
        });

        chartArea.addEventListener('mouseleave', () => {
            jalankanAnimasi(persenLunas, persenBelumLunas);
        });
    });
</script>
