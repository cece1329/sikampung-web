<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Bikin Akun Admin
        User::create([
            'name' => 'Admin Joyotakan',
            'email' => 'admin@joyotakan.com',
            'pin' => '123456', // PIN saktimu!
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        // Bikin Akun Warga buat Tes
        User::create([
            'name' => 'Warga Joyotakan',
            'email' => 'warga@joyotakan.com',
            'nik' => '1234567890123456', // NIK 16 digit buat login warga
            'role' => 'warga',
            'password' => bcrypt('password'),
        ]);
    }
}