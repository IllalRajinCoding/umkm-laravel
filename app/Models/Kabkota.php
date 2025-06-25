<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabkota extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     *
     * @var string
     */
    protected $table = 'kabkota';

    /**
     * Atribut yang bisa diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'latitude',
        'longitude',
        'provinsi_id',
    ];

    /**
     * Mendefinisikan relasi 'belongsTo' ke model Provinsi.
     * Setiap kabkota dimiliki oleh satu provinsi.
     */
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }

    /**
     * Mendefinisikan relasi 'hasMany' ke model Umkm.
     * Setiap kabkota bisa memiliki banyak UMKM.
     */
    public function umkm()
    {
        return $this->hasMany(Umkm::class, 'kabkota_id');
    }
}
