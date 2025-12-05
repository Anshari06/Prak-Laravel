<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'idpet';

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'warna_tanda',
        'jenis_kelamin',
        'idpemilik',
        'idras_hewan',
        'description',
    ];

    public $timestamps = false;

    public function ras_hewan()
    {
        return $this->belongsTo(Ras_Hewan::class, 'idras_hewan', 'idras_hewan');
    }

    public function jenis_hewan()
    {
        return $this->ras_hewan->jenisHewan();
    }

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    public function rekam_medis()
    {
        return $this->hasMany(RekamMedis::class, 'idpet', 'idpet');
    }
}
