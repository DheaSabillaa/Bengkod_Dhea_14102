<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_obat',
        'kemasan',
        'harga',
    ];

    // protected $dates = ['deleted_at'];

    public function detailPeriksas():HasMany
    {
        return $this->hasMany(DetailPeriksa::class, 'id_obat');
    }
    public function periksas()
{
    return $this->belongsToMany(Periksa::class, 'obat_periksa');
}

}
