<?php

namespace App\Imports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; // Tambahkan ini agar membaca baris pertama sebagai judul

class MemberImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Member([
            'nama'    => $row['nama'],    // Harus sama dengan tulisan di header Excel Anda
            'alamat'  => $row['alamat'],
            'telepon' => $row['telepon'],
            'status'  => $row['status'] ?? 'Aktif',
        ]);
    }
}
