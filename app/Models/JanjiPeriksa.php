<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


class JanjiPeriksa extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_rm', // Nomor Rekam Medis
        'id_pasien',
        'id_jadwal_periksa',
        'id_poli',
        'keluhan',
        'no_antrian',
        'status',
    ];

    /**
     * Relasi ke model User (pasien)
     */
    public function pasien(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    /**
     * Relasi ke model JadwalPeriksa
     */
    public function jadwalPeriksa(): BelongsTo
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal_periksa');
    }

    /**
     * Relasi ke model Poli
     */
    public function poli(): BelongsTo
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    /**
     * Relasi ke model Periksa
     */
    public function periksa(): HasOne
    {
        return $this->hasOne(Periksa::class, 'id_janji_periksa');
    }

    

}
