<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pasiens = [
            [
                'nama' => 'Andi Pratama',
                'email' => 'andi.pratama@klinik.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta Selatan',
                'no_hp' => '081234567810',
                'no_ktp' => '3175061505950001',
                'no_rm' => 'RM001',

            ],
            [
                'nama' => 'Siti Aminah',
                'email' => 'siti.aminah@klinik.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'alamat' => 'Jl. Sudirman No. 25, Jakarta Pusat',
                'no_hp' => '081234567811',
                'no_ktp' => '3175062706830002',
                'no_rm' => 'RM002',

            ],
            [
                'nama' => 'Rudi Santoso',
                'email' => 'rudi.santoso@klinik.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'alamat' => 'Jl. Gatot Subroto No. 33, Jakarta Barat',
                'no_hp' => '081234567812',
                'no_ktp' => '3175060508800003',
                'no_rm' => 'RM003',

            ],
            [
                'nama' => 'Lina Sari',
                'email' => 'lina.sari@klinik.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'alamat' => 'Jl. Thamrin No. 45, Jakarta Timur',
                'no_hp' => '081234567813',
                'no_ktp' => '3175061409910004',
                'no_rm' => 'RM004',

            ],
            [
                'nama' => 'Budi Wijaya',
                'email' => 'budi.wijaya@klinik.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'alamat' => 'Jl. Hayam Wuruk No. 67, Jakarta Utara',
                'no_hp' => '081234567814',
                'no_ktp' => '3175063007860005',
                'no_rm' => 'RM005',

            ],
        ];

        foreach ($pasiens as $pasien) {
            User::firstOrCreate(
                ['email' => $pasien['email'], 'no_ktp' => $pasien['no_ktp']],
                $pasien
            );
        }
    }
}
