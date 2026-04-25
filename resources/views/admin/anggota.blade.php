<x-app-layout>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Manajemen Anggota</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola data seluruh anggota STT Dharma Satya Mandala.</p>
        </div>
        <button
            class="flex items-center justify-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-semibold shadow-lg shadow-emerald-900/10 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Anggota
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50 bg-gray-50/50 flex flex-col md:flex-row gap-4">
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </span>
                <input type="text"
                    class="block w-full pl-10 pr-4 py-2.5 border-gray-200 rounded-xl bg-white focus:ring-emerald-500 focus:border-emerald-500 text-sm"
                    placeholder="Cari berdasarkan nama, telepon, atau alamat...">
            </div>
            <select
                class="px-4 py-2.5 border-gray-200 rounded-xl bg-white text-sm focus:ring-emerald-500 focus:border-emerald-500">
                <option>Semua Status</option>
                <option>Aktif</option>
                <option>Non-Aktif</option>
            </select>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead class="bg-gray-50/50">
                    <tr class="text-xs font-bold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Nama Anggota</th>
                        <th class="px-6 py-4">Telepon</th>
                        <th class="px-6 py-4">Alamat</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @php
                        // Dummy Data untuk Mockup
                        $anggota = [
                            ['Ketut Astawa', '0812-3456-7890', 'Blok i3 / 15', 'Aktif'],
                            ['Gede Sugiarta', '0813-2345-6789', 'Blok B2 / 07', 'Aktif'],
                            ['Putu Juniantari', '0814-5678-9012', 'Blok C1 / 12', 'Aktif'],
                            ['Agus Wirawan', '0815-6789-0123', 'Blok i3 / 15', 'Non-Aktif'],
                        ];
                    @endphp

                    @foreach ($anggota as $index => $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xs">
                                        {{ substr($item[0], 0, 1) }}
                                    </div>
                                    <span class="text-sm font-semibold text-gray-800">{{ $item[0] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item[1] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item[2] }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 text-xs font-medium rounded-full {{ $item[3] == 'Aktif' ? 'bg-emerald-50 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $item[3] }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                        title="Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition"
                                        title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition"
                                        title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div
            class="px-6 py-4 bg-gray-50/50 border-t border-gray-100 flex items-center justify-between text-sm text-gray-500">
            <p>Menampilkan 1 - 4 dari 70 data</p>
            <div class="flex gap-2">
                <button
                    class="px-3 py-1.5 border border-gray-200 rounded-lg hover:bg-white transition disabled:opacity-50">Sebelumnya</button>
                <button class="px-3 py-1.5 bg-emerald-600 text-white rounded-lg font-medium">1</button>
                <button class="px-3 py-1.5 border border-gray-200 rounded-lg hover:bg-white transition">2</button>
                <button
                    class="px-3 py-1.5 border border-gray-200 rounded-lg hover:bg-white transition">Selanjutnya</button>
            </div>
        </div>
    </div>
</x-app-layout>
