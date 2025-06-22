<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriUmkm extends Model
{
    protected $table = 'kategori_umkm';

    protected $fillable = [
        'nama',
    ];

    public function umkm()
    {
        return $this->hasMany(Umkm::class, 'kategori_id');
    }
}
