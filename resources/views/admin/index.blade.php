<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-emerald-50 rounded-full text-emerald-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Total Anggota</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">70</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-emerald-50 rounded-full text-emerald-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Saldo Kas STT</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">Rp 4.308.000</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-emerald-50 rounded-full text-emerald-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Iuran Bulan Ini</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">2</h3>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">

        <div class="w-full lg:w-2/3 bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex items-center gap-3 mb-8">
                <div class="p-2 bg-gray-100 rounded-lg text-gray-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Daftar Tunggakan Iuran Terakhir</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="p-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Anggota
                            </th>
                            <th class="p-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Bulan Tunggakan
                            </th>
                            <th class="p-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah</th>
                            <th class="p-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 text-sm font-medium text-gray-800">Ketut Astawa</td>
                            <td class="p-4 text-sm text-gray-600">Mei 2026</td>
                            <td class="p-4 text-sm text-gray-600">Rp 50.000</td>
                            <td class="p-4">
                                <span
                                    class="px-3 py-1 text-xs font-medium text-rose-700 bg-rose-50 rounded-full">Menunggu</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 text-sm font-medium text-gray-800">Gede Sugiarta</td>
                            <td class="p-4 text-sm text-gray-600">April 2026</td>
                            <td class="p-4 text-sm text-gray-600">Rp 50.000</td>
                            <td class="p-4">
                                <span
                                    class="px-3 py-1 text-xs font-medium text-amber-700 bg-amber-50 rounded-full">Belum
                                    Dibayar</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 text-sm font-medium text-gray-800">Putu Juniantari</td>
                            <td class="p-4 text-sm text-gray-600">Mei 2026</td>
                            <td class="p-4 text-sm text-gray-600">Rp 50.000</td>
                            <td class="p-4">
                                <span
                                    class="px-3 py-1 text-xs font-medium text-rose-700 bg-rose-50 rounded-full">Menunggu</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 text-sm font-medium text-gray-800">Agus Wirawan</td>
                            <td class="p-4 text-sm text-gray-600">Mei 2026</td>
                            <td class="p-4 text-sm text-gray-600">Rp 50.000</td>
                            <td class="p-4">
                                <span
                                    class="px-3 py-1 text-xs font-medium text-amber-700 bg-amber-50 rounded-full">Belum
                                    Dibayar</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-8 text-center border-t border-gray-100 pt-6">
                <a href="#"
                    class="text-sm font-semibold text-emerald-700 hover:text-emerald-800 flex items-center justify-center gap-2">
                    Lihat semua tunggakan
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <div class="w-full lg:w-1/3 space-y-8">
            <div class="bg-amber-500 text-white p-8 rounded-2xl shadow-lg shadow-amber-900/10 flex items-start gap-5">
                <div class="p-3 bg-white/20 rounded-full">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-xl font-bold">Pembayaran Bulan Mei Sudah Aktif</h4>
                    <p class="text-sm text-white/90 mt-2 leading-relaxed">Pembayaran iuran untuk bulan Mei sudah dapat
                        dilakukan.</p>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col gap-6">
                <div class="flex items-start gap-4">
                    <div class="p-2 bg-amber-50 rounded-lg text-amber-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-base font-semibold text-gray-800">Informasi Iuran Bulanan</h4>
                        <p class="text-sm text-gray-600 mt-2 leading-relaxed">Pastikan iuran bulan ini sudah dibayar
                            sebelum tanggal <span class="font-bold text-rose-600">10 setiap bulannya</span> untuk
                            menghindari denda.</p>
                    </div>
                </div>

                <button
                    class="w-full text-center bg-white border border-gray-200 text-gray-700 py-3.5 rounded-xl font-semibold flex items-center justify-center gap-3 hover:border-gray-300 hover:bg-gray-50 transition shadow-sm">
                    Cek Keuangan Saya
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
