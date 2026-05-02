<x-app-layout>
    <div class="min-h-screen flex flex-col items-center justify-start pt-12 pb-12 px-4">

        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Edit Anggota</h2>
            <p class="text-sm text-gray-500 mt-1">Perbarui informasi anggota STT Dharma Satya Mandala.</p>
        </div>

        <div class="w-full max-w-xl bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
            <form action="{{ route('member.update', $member->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Anggota</label>
                        <input type="text" name="nama" value="{{ old('nama', $member->nama) }}"
                            class="w-full rounded-xl border-2 border-gray-200 py-3 px-4 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none"
                            placeholder="Masukkan nama lengkap">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="text" name="telepon" value="{{ old('telepon', $member->telepon) }}"
                            class="w-full rounded-xl border-2 border-gray-200 py-3 px-4 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none"
                            placeholder="Contoh: 08123456789">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                        <textarea name="alamat" rows="3"
                            class="w-full rounded-xl border-2 border-gray-200 py-3 px-4 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none"
                            placeholder="Masukkan alamat lengkap">{{ old('alamat', $member->alamat) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select name="status"
                            class="w-full rounded-xl border-2 border-gray-200 py-3 px-4 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none appearance-none bg-white">
                            <option value="Aktif" {{ $member->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Non-Aktif" {{ $member->status == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>
                </div>

                <div class="mt-10 flex flex-col sm:flex-row gap-3">
                    <button type="submit"
                        class="flex-1 px-6 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold shadow-lg shadow-emerald-900/10 transition-all">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('member.index') }}"
                        class="flex-1 px-6 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl font-bold text-center transition-all">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
