<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'Kategori';
    protected $primaryKey = 'idkategori';

    protected $fillable = [
        'nama_kategori',
    ];

    public function kat_tindakans()
    {
        return $this->hasMany(kat_tindakan::class, 'idkategori', 'idkategori');
    }
}
