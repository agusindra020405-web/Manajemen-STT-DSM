<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MemberImport;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $file = storage_path('app/public/import/data_anggota_stt.xlsx');

        // Cek secara fisik apakah file benar-to-benar ada di folder tersebut
        if (file_exists($file)) {
            $this->command->info("File Excel ditemukan. Memulai import data anggota...");

            Excel::import(new MemberImport, $file);

            $this->command->info("Proses eksekusi selesai! Silakan periksa tabel 'members'.");
        } else {
            // Jika path salah atau file hilang, terminal akan langsung memberitahu Anda
            $this->command->error("Gagal: File tidak ditemukan di jalur path: " . $file);
        }
    }
}
