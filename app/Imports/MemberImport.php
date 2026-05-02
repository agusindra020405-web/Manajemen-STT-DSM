<?php

namespace App\Imports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; 

class MemberImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Member([
            'name'    => $row['nama'],    
            'address'  => $row['alamat'],
            'phone' => $row['telepon'],
            'status'  => $row['status'] ?? 'Aktif',
        ]);
    }
}
