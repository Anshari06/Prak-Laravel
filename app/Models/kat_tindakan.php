<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kat_tindakan extends Model
{
    protected $table = 'kode_tindakan_terapi';
    protected $primaryKey = 'idkode_tindakan_terapi';

    protected $fillable = [
        'deskripsi_tindakan_terapi',
        'idkategori',
        'idkategori_klinis',
    ];

    public function kategori()
    {
        return $this->belongsTo(Categories::class, 'idkategori', 'idkategori');
    }

    public function kat_klinis()
    {
        return $this->belongsTo(Kat_Klinis::class, 'idkategori_klinis', 'idkategori_klinis');
    }

    public function detailRekams()
    {
        return $this->belongsToMany(detailRekam::class, 'idkode_tindakan_terapi', 'idkode_tindakan_terapi');
    }
}
