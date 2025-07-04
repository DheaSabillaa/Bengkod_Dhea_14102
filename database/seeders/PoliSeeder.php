<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poli;

class PoliSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        $polis = [
            ['nama_poli' => 'Poli Umum', 'keterangan' => 'Poli untuk pemeriksaan umum'],
            ['nama_poli' => 'Poli Gigi', 'keterangan' => 'Poli untuk perawatan gigi'],
            ['nama_poli' => 'Poli Anak', 'keterangan' => 'Poli khusus anak-anak'],
            ['nama_poli' => 'Poli Kandungan', 'keterangan' => 'Poli untuk pemeriksaan kandungan'],
            ['nama_poli' => 'Poli THT', 'keterangan' => 'Poli untuk telinga, hidung, dan tenggorokan'],
            ['nama_poli' => 'Poli Mata', 'keterangan' => 'Poli untuk pemeriksaan mata'],
            ['nama_poli' => 'Poli Bedah', 'keterangan' => 'Poli untuk tindakan bedah'],
        ];

        foreach ($polis as $poli) {
            Poli::firstOrCreate(['nama_poli' => $poli['nama_poli']], $poli);
        }
    }
}
