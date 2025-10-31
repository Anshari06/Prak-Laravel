<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ras_hewan extends Model
{
    protected $table = 'ras_hewan';

    protected $fillable = [
        'nama_ras',
        'id_jenis_hewan',
    ];

    public function jenisHewan()
    {
        return $this->belongsTo(Jenis_Hewan::class, 'idjenis_hewan');
    }

    public function pets()
    {
        return $this->hasMany(Pet::class, 'idras_hewan', 'idras_hewan');
    }
}
