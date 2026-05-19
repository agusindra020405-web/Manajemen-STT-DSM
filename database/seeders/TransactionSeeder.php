<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mengosongkan tabel transactions terlebih dahulu agar tidak double saat dijalankan ulang
        DB::table('transactions')->truncate();

        // Memasukkan data riwayat sesuai dengan gambar tampilan riwayat Anda
        DB::table('transactions')->insert([
            [
                'member_id' => 1, // Pastikan ID member ini sesuai dengan data di tabel members Anda
                'month' => 'Januari 2026',
                'year' => '2026',
                'amount' => 50000,
                'status' => 'PAID',
                'payment_method' => 'CASH',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'member_id' => 1,
                'month' => 'Februari 2026',
                'year' => '2026',
                'amount' => 50000,
                'status' => 'PAID',
                'payment_method' => 'CASH',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'member_id' => 1,
                'month' => 'Maret 2026',
                'year' => '2026',
                'amount' => 50000,
                'status' => 'PAID',
                'payment_method' => 'CASH',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'member_id' => 1,
                'month' => 'April 2026',
                'year' => '2026',
                'amount' => 50000,
                'status' => 'PAID',
                'payment_method' => 'CASH',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'member_id' => 1,
                'month' => 'Mei 2026',
                'year' => '2026',
                'amount' => 50000,
                'status' => 'UNPAID', // Sesuai tampilan Anda: "Belum Lunas / Menunggu Pembayaran"
                'payment_method' => 'CASH',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
