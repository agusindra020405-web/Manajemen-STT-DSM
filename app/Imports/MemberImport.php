<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Member;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MemberImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // 1. Jika kolom nama di Excel kosong, lewati baris ini
        if (empty($row['nama'])) {
            return null;
        }

        // 2. Cari apakah nama ini sudah terdaftar sebagai pengurus dari DatabaseSeeder
        $user = User::where('name', trim($row['nama']))->first();

        // 3. Jika belum terdaftar, buatkan akun user baru untuk anggota biasa
        if (!$user) {
            $cleanName = Str::slug($row['nama'], '.');
            $generatedEmail = $cleanName . '@stt.com';

            $user = User::create([
                'name'     => $row['nama'],
                'email'    => $generatedEmail,
                'password' => Hash::make('password123'),
                'role'     => 'member',
            ]);
        }

        // 4. Masukkan data ke tabel members dan pasangkan user_id miliknya
        return new Member([
            'user_id' => $user->id,
            'name'    => $row['nama'],
            'phone'   => $row['telepon'] ?? null,
            'address' => $row['alamat'] ?? null,
            'status'  => $row['status'] ?? 'Aktif',
        ]);
    }
}
