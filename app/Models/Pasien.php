<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens'; // nama tabel di database

    protected $fillable = [
        'nama',
        'alamat',
        'no_ktp',
        'no_hp',
        'no_rm',
    ];
    public function pendaftaranPolis()
{
    return $this->hasMany(\App\Models\PendaftaranPoli::class, 'id_pasien');
}
}

