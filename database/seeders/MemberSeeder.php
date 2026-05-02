<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MemberImport;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan file data_anggota.xlsx sudah diletakkan di folder storage/app/public/
        $file = storage_path('app/public/import/data_anggota_stt.xlsx');

        Excel::import(new MemberImport, $file);
    }
}
