<x-app-layout>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Manajemen Anggota</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola data seluruh anggota STT Dharma Satya Mandala.</p>
        </div>
        <a href="{{ route('member.create') }}"
            class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-semibold transition-all">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Anggota
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50 bg-gray-50/50 flex flex-col md:flex-row gap-4">
            {{-- Form Pencarian --}}
            <form action="{{ route('member.index') }}" method="GET" class="relative flex-1">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                    class="block w-full pl-10 pr-4 py-2.5 border-gray-200 rounded-xl bg-white focus:ring-emerald-500 focus:border-emerald-500 text-sm"
                    placeholder="Cari berdasarkan nama, telepon, atau alamat..." onblur="this.form.submit()">
                {{-- Form akan terkirim saat user klik di luar input atau tekan Enter --}}

                @if (request('search'))
                    <a href="{{ route('member.index') }}"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-rose-500 hover:text-rose-700 text-xs font-medium">
                        Hapus Pencarian
                    </a>
                @endif
            </form>
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
                    {{-- $members diambil dari Controller --}}
                    @foreach ($members as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            {{-- Nomor urut otomatis (mendukung pagination) --}}
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ ($members->currentPage() - 1) * $members->perPage() + $loop->iteration }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xs">
                                        {{ substr($item->name, 0, 1) }}
                                    </div>
                                    <span class="text-sm font-semibold text-gray-800">{{ $item->name }}</span>
                                </div>
                            </td>

                            {{-- Memanggil kolom telepon, alamat, dan status dari database --}}
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item->phone }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item->address }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 text-xs font-medium rounded-full {{ $item->status == 'Aktif' ? 'bg-emerald-50 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $item->status }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('member.edit', $item->id) }}"
                                        class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition"
                                        title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('member.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota {{ $item->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition"
                                            title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Bagian Pagination --}}
            <div
                class="px-6 py-4 bg-gray-50/50 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4">
                {{-- Info Data Otomatis --}}
                <p class="text-sm text-gray-500">
                    Menampilkan <span class="font-medium text-emerald-600">{{ $members->firstItem() }}</span>
                    sampai <span class="font-medium text-emerald-600">{{ $members->lastItem() }}</span>
                    dari <span class="font-medium text-emerald-600">{{ $members->total() }}</span> data
                </p>

                {{-- Tombol Navigasi --}}
                <div class="pagination-custom">
                    {{ $members->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
</x-app-layout>
