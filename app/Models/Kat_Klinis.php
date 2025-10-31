<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kat_Klinis extends Model
{
    protected $table = 'kategori_klinis';
    protected $primaryKey = 'idkategori_klinis';

    protected $fillable = [
        'nama_kategori_klinis',
        'deskripsi',
    ];

    public function kat_tindakans()
    {
        return $this->hasMany(kat_tindakan::class, 'idkategori_klinis', 'idkategori_klinis');
    }
}
