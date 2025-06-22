<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'provinsi';

    protected $fillable = [
        'nama',
        'ibukota',
        'latitude',
        'longitude',
    ];

    public function kabkota()
    {
        return $this->hasMany(Kabkota::class, 'provinsi_id');
    }

    public function umkm()
    {
        return $this->hasManyThrough(Umkm::class, Kabkota::class, 'provinsi_id', 'kabkota_id');
    }
}
