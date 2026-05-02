<x-app-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Iuran</h2>
        <p class="text-sm text-gray-500 mt-1">Kelola iuran anggota dan pantau status pembayaran secara real-time.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">1. Target Iuran Bulan Ini</p>
                <h3 class="text-xl font-bold text-gray-800 mt-2">Rp</h3>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">2. Iuran Terbayar</p>
                        <h3 class="text-xl font-bold text-gray-800 mt-2">Rp</h3>
                    </div>

                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">3. Total Tunggakan</p>
                <h3 class="text-xl font-bold text-gray-800 mt-2">Rp</h3>
                <div class="absolute -right-2 -bottom-2 opacity-10 text-rose-600">

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
                <select class="text-sm border-gray-200 rounded-xl focus:ring-emerald-500 focus:border-emerald-500">
                    <option>April 2026</option>
                </select>
                <select class="text-sm border-gray-200 rounded-xl focus:ring-emerald-500 focus:border-emerald-500">
                    <option>Status: Semua</option>
                </select>
                <div class="relative">
                    <input type="text" placeholder="Cari iuran..."
                        class="pl-10 pr-4 py-2 border-gray-200 rounded-xl text-sm focus:ring-emerald-500">
                    <svg class="w-4 h-4 absolute left-3 top-3 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
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
                                @if (!$member->contributions->first() || $member->contributions->first()->status != 'LUNAS')
                                    <button
                                        class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-[10px] font-bold rounded-xl shadow-md shadow-emerald-200 transition">
                                        Bayar via Midtrans
                                    </button>
                                @else
                                    <button class="p-2 text-gray-400 hover:text-emerald-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                    </button>
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
