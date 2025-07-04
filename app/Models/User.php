<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\JanjiPeriksa;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'no_ktp',
        'email',
        'password',
        'role',
        'no_rm',
        'poli', // Relasi ke tabel Poli
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke tabel Periksa sebagai pasien
     */
    public function pasiens(): HasMany
    {
        return $this->hasMany(Periksa::class, 'id_pasien');
    }

    /**
     * Relasi ke tabel Periksa sebagai dokter
     */
    public function dokters(): HasMany
    {
        return $this->hasMany(Periksa::class, 'id_dokter');
    }

     public function jadwalPeriksas()
    {
        return $this->hasMany(JadwalPeriksa::class, 'id_dokter');
    }

       public function janjiPeriksas()
    {
        return $this->hasMany(JanjiPeriksa::class, 'id_pasien');
    }
    public function poli(): BelongsTo
{
    return $this->belongsTo(Poli::class, 'id_poli');
}

}
