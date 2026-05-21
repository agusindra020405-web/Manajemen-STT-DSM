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
                        @php
                            // Ambil data iuran untuk baris ini agar variabel $contribution tersedia.
                            // Jika ada record PAID dan UNPAID pada periode yang sama, gunakan yang sudah dibayar.
                            $contribution =
                                $member->contributions->where('status', 'PAID')->first() ??
                                $member->contributions->first();
                            $isLunas = $contribution && $contribution->status == 'PAID';
                        @endphp

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
                                @if ($isLunas)
                                    <span
                                        class="px-3 py-1 bg-emerald-50 text-emerald-700 text-[10px] font-bold rounded-full uppercase">Lunas</span>
                                @else
                                    <span
                                        class="px-3 py-1 bg-rose-50 text-rose-600 text-[10px] font-bold rounded-full uppercase">Tertunggak</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if (!$isLunas)
                                        <form action="{{ route('admin.contributions.payCash', $member->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="bulan" value="{{ $bulanSekarang }}">
                                            <input type="hidden" name="tahun" value="{{ $tahunSekarang }}">

                                            <button type="submit"
                                                onclick="return confirm('Konfirmasi pembayaran tunai untuk {{ $member->name }}?')"
                                                class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-[10px] font-bold rounded-xl shadow-md transition flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="3" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Konfirmasi Tunai
                                            </button>
                                        </form>
                                    @else
                                        <div
                                            class="flex items-center text-emerald-600 font-bold text-[10px] gap-2 mr-2">
                                            <span class="bg-emerald-100 p-1 rounded-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="3" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </span>
                                            Tercatat
                                        </div>

                                        {{-- Tombol Batal --}}
                                        @if (isset($contribution->id))
                                            <button type="button"
                                                onclick="openCancelModal('{{ $contribution->id }}', '{{ $member->name }}')"
                                                class="p-2 bg-rose-50 hover:bg-rose-100 text-rose-500 rounded-lg border border-rose-100 transition-colors"
                                                title="Batalkan Pembayaran">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>

                                            {{-- Tombol Cetak PDF (Link Biasa/GET) --}}
                                            <a href="{{ route('admin.contributions.print', $contribution->id) }}"
                                                target="_blank"
                                                class="p-2 bg-gray-50 hover:bg-emerald-50 text-gray-400 hover:text-emerald-600 rounded-lg border border-gray-100 transition-colors"
                                                title="Cetak Invoice PDF">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                                </svg>
                                            </a>
                                        @endif
                                    @endif
                                </div>
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

    <!-- Modal Batal -->
    <div id="modalBatal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900 bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Batalkan Pembayaran</h3>
                    <p class="text-xs text-gray-500 mb-4">Anggota: <span id="cancelMemberName"
                            class="font-bold text-gray-700"></span></p>

                    <form id="formBatal" method="POST">
                        @csrf
                        @method('POST')
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Alasan
                                    Pembatalan</label>
                                <textarea name="reason_cancel" required class="w-full border-gray-200 rounded-xl text-sm focus:ring-rose-500"
                                    placeholder="Contoh: Salah klik" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 mt-6">
                            <button type="button" onclick="closeCancelModal()"
                                class="text-sm font-bold text-gray-500 hover:text-gray-700">Tutup</button>
                            <button type="submit"
                                class="px-6 py-2 bg-rose-600 hover:bg-rose-700 text-white text-sm font-bold rounded-xl transition">
                                Konfirmasi Batalkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function openModal() {
        document.getElementById('modalIuranKolektif').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modalIuranKolektif').classList.add('hidden');
    }

    function openCancelModal(id, name) {
        // Set nama anggota di modal
        document.getElementById('cancelMemberName').innerText = name;
        // Set action form secara dinamis
        const form = document.getElementById('formBatal');
        form.action = `/admin/contributions/cancel/${id}`;

        document.getElementById('modalBatal').classList.remove('hidden');
    }

    function closeCancelModal() {
        document.getElementById('modalBatal').classList.add('hidden');
    }
</script>
