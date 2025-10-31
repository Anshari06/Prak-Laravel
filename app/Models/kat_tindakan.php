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
}
