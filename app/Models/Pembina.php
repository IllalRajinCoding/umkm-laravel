<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembina extends Model
{
    protected $table = 'pembina';

    protected $fillable = [
        'nama',
        'gender',
        'tgl_lahir',
        'tmp_lahir',
        'keahlian',
    ];

    public function umkm()
    {
        return $this->hasMany(Umkm::class, 'pembina_id');
    }
}
