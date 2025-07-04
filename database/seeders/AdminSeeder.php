<?php

namespace Database\Seeders;

// database/seeders/AdminSeeder.php
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'nama' => 'Admin',
            'alamat' => 'Admin Center',
            'no_hp' => '08123456789',
            'no_ktp' => '1234567890123456',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);
    }
}
