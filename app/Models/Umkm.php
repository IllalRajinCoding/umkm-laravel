<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkm';

    protected $fillable = [
        'user_id',
        'nama',
        'modal',
        'alamat',
        'telepon',
        'email',
        'website',
        'rating',
        'pembina_id',
        'kabkota_id',
        'kategori_umkm_id',
        'status'
    ];

    public $timestamps = false;

    public function pembina()
    {
        return $this->belongsTo(Pembina::class, 'pembina_id');
    }

    public function kabkota()
    {
        return $this->belongsTo(Kabkota::class, 'kabkota_id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriUmkm::class, 'kategori_umkm_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
