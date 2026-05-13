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
                'role' => 'admin'
            ]
        );

        // User 2: Sekretaris Satu 
        User::updateOrCreate(
            ['id' => 2],
            [
                'name' => 'Ida Bagus Komang Wicaksana',
                'email' => 'sekretaris1@stt.com',
                'password' => bcrypt('password123'),
                'role' => 'admin'
            ]
        );

        // User 3: Bendahara Satu 
        User::updateOrCreate(
            ['id' => 3],
            [
                'name' => 'Putu Krisna Manik Surya Winata',
                'email' => 'bendahara1@stt.com',
                'password' => bcrypt('password123'),
                'role' => 'admin'
            ]
        );

        // User 4: Wakil
        User::updateOrCreate(
            ['id' => 4],
            [
                'name' => 'I Made Agus Indra Setiawan',
                'email' => 'wakil@stt.com',
                'password' => bcrypt('password123'),
                'role' => 'admin'
            ]
        );

        // User 5: Sekretaris Dua
        User::updateOrCreate(
            ['id' => 5],
            [
                'name' => 'Ida Ayu Indri Pradnyandari',
                'email' => 'sekretaris2@stt.com', // Sudah diperbaiki menjadi sekretaris2
                'password' => bcrypt('password123'),
                'role' => 'admin'
            ]
        );

        // User 6: Bendahara Dua
        User::updateOrCreate(
            ['id' => 6],
            [
                'name' => 'Ni Komang Feby Chintya Bella',
                'email' => 'bendahara2@stt.com', // Sudah diperbaiki menjadi bendahara2
                'password' => bcrypt('password123'),
                'role' => 'admin'
            ]
        );

        $this->call([
            MemberSeeder::class,
        ]);
    }
}
