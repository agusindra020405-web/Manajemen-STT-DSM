<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User 1: Ketua
        User::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Ketut Deny Trisna Putra',
                'email' => 'ketua@stt.com',
                'password' => bcrypt('password123'),
                'role' => 'ketua'
            ]
        );

        // User 4: Wakil
        User::updateOrCreate(
            ['id' => 4],
            [
                'name' => 'I Made Agus Indra Setiawan',
                'email' => 'wakil@stt.com',
                'password' => bcrypt('password123'),
                'role' => 'wakil'
            ]
        );


        User::updateOrCreate(['id' => 2], ['name' => 'Sekretaris Satu', 'email' => 'sekretaris1@stt.com', 'password' => bcrypt('password123'), 'role' => 'admin']);
        User::updateOrCreate(['id' => 3], ['name' => 'Bendahara Satu', 'email' => 'bendahara1@stt.com', 'password' => bcrypt('password123'), 'role' => 'admin']);
        User::updateOrCreate(['id' => 5], ['name' => 'Sekretaris Dua', 'email' => 'sekretaris2@stt.com', 'password' => bcrypt('password123'), 'role' => 'admin']);
        User::updateOrCreate(['id' => 6], ['name' => 'Bendahara Dua', 'email' => 'bendahara2@stt.com', 'password' => bcrypt('password123'), 'role' => 'admin']);

        $this->call([
            MemberSeeder::class,
        ]);
    }
}
