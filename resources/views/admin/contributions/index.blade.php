<x-app-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Iuran</h2>
        <p class="text-sm text-gray-500 mt-1">Kelola iuran anggota dan pantau status pembayaran secara real-time.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Card 1: Anggota Lunas -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden">
                <div class="flex justify-between items-start relative z-10">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">1. Sudah Bayar</p>
                        <h3 class="text-xl font-bold text-gray-800 mt-2">{{ $totalLunas }} <span
                                class="text-sm font-normal text-gray-500">Anggota</span></h3>
                    </div>
                    <div class="bg-emerald-50 p-2 rounded-lg text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 2: Anggota Menunggak -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden">
                <div class="flex justify-between items-start relative z-10">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">2. Menunggak</p>
                        <h3 class="text-xl font-bold text-rose-600 mt-2">{{ $totalMenunggak }} <span
                                class="text-sm font-normal text-gray-500">Anggota</span></h3>
                    </div>
                    <div class="bg-rose-50 p-2 rounded-lg text-rose-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 3: Total Dana Terkumpul -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">3. Total Uang Masuk</p>
                    <h3 class="text-xl font-bold text-gray-800 mt-2">Rp {{ number_format($danaTerkumpul, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border-2 border-emerald-50 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-bold text-gray-800 text-sm">Pembayaran Digital</h4>
                    <span
                        class="px-2 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-bold rounded-lg uppercase tracking-tight">Status:
                        Aktif</span>
                </div>
                <div class="flex items-center gap-3 mb-4">
                    <img src="" alt="Midtrans" class="h-6">
                </div>
                <p class="text-xs text-gray-500 leading-relaxed">Anggota dapat membayar iuran secara mandiri via
                    Midtrans.</p>
            </div>
            <button
                class="w-full mt-4 py-2 border-2 border-gray-200 rounded-xl text-xs font-bold text-gray-700 hover:bg-gray-50 transition">Atur
                Midtrans</button>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center gap-4">
            <h3 class="font-bold text-gray-800 text-sm">Daftar Riwayat Iuran</h3>
            <div class="flex flex-wrap items-center gap-3">
                <form action="{{ route('admin.contributions.index') }}" method="GET"
                    class="flex flex-wrap items-center gap-3">
                    <!-- Tetap bawa filter bulan & status saat search -->
                    <select name="bulan" onchange="this.form.submit()"
                        class="text-sm border-gray-200 rounded-xl focus:ring-emerald-500">
                        @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $m)
                            <option value="{{ $m }}" {{ $bulanSekarang == $m ? 'selected' : '' }}>
                                {{ $m }}</option>
                        @endforeach
                    </select>

                    <select name="status" onchange="this.form.submit()"
                        class="text-sm border-gray-200 rounded-xl focus:ring-emerald-500">
                        <option value="">Status: Semua</option>
                        <option value="PAID" {{ request('status') == 'PAID' ? 'selected' : '' }}>Status: Lunas
                        </option>
                        <option value="UNPAID" {{ request('status') == 'UNPAID' ? 'selected' : '' }}>Status: Menunggak
                        </option>
                    </select>

                    <!-- Search Input -->
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama ..."
                            class="pl-10 pr-4 py-2 border-gray-200 rounded-xl text-sm focus:ring-emerald-500"
                            onkeypress="if(event.keyCode == 13) { this.form.submit(); }">

                        <div class="absolute left-3 top-2.5 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>

                        <!-- Tombol Reset Search -->
                        @if (request('search'))
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <a href="{{ route('admin.contributions.index', ['bulan' => $bulanSekarang]) }}"
                                    class="text-gray-400 hover:text-rose-500 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                </form>

            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Nama Anggota</th>
                        <th class="px-6 py-4">Bulan</th>
                        <th class="px-6 py-4">Jumlah</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm">
                    @foreach ($members as $index => $member)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4 text-gray-500">{{ $members->firstItem() + $index }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-[10px]">
                                        {{ substr($member->name, 0, 1) }}
                                    </div>
                                    <span class="font-semibold text-gray-800 text-xs">{{ $member->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600 text-xs text-center">{{ $bulanSekarang }}</td>
                            <td class="px-6 py-4 font-medium text-gray-800">Rp 50.000</td>
                            <td class="px-6 py-4">
                                @if ($member->contributions->first() && $member->contributions->first()->status == 'PAID')
                                    <span
                                        class="px-3 py-1 bg-emerald-50 text-emerald-700 text-[10px] font-bold rounded-full uppercase">Lunas</span>
                                @else
                                    <span
                                        class="px-3 py-1 bg-rose-50 text-rose-600 text-[10px] font-bold rounded-full uppercase">Tertunggak</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right">
                                @php
                                    $isLunas =
                                        $member->contributions->first() &&
                                        $member->contributions->first()->status == 'PAID';
                                @endphp

                                @if (!$isLunas)
                                    <!-- Tombol Bayar Tunai -->
                                    <form action="{{ route('admin.contributions.payCash', $member->id) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="bulan" value="{{ $bulanSekarang }}">
                                        <input type="hidden" name="tahun" value="{{ $tahunSekarang }}">

                                        <button type="submit"
                                            onclick="return confirm('Konfirmasi pembayaran tunai untuk {{ $member->name }}?')"
                                            class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-[10px] font-bold rounded-xl shadow-md shadow-emerald-200 transition flex items-center gap-2 ml-auto">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Konfirmasi Tunai
                                        </button>
                                    </form>
                                @else
                                    <!-- Ikon centang jika sudah lunas -->
                                    <div
                                        class="flex items-center justify-end text-emerald-600 font-bold text-[10px] gap-2">
                                        <span class="bg-emerald-100 p-1 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </span>
                                        Tercatat
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-6 py-4 border-t border-gray-50 bg-gray-50/30">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-xs text-gray-500">
                        Menampilkan <span class="font-bold text-emerald-600">{{ $members->firstItem() }}</span>
                        sampai <span class="font-bold text-emerald-600">{{ $members->lastItem() }}</span>
                        dari <span class="font-bold text-emerald-600">{{ $members->total() }}</span> data
                    </p>
                    <div class="pagination-emerald">
                        {{ $members->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
