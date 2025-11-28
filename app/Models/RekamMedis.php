<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';

    protected $fillable = [
        'created_at',
        'anamnesa',
        'diagnosa',
        'temuan_klinis',
        'idpet',
        'dokter_pemeriksa',
        'idreservasi_dokter',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    public function detailRekams()
    {
        return $this->hasMany(detailRekam::class, 'idrekam_medis', 'idrekam_medis');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_pemeriksa', 'idrole_user');
    }
    
}
