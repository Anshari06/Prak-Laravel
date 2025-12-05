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

    /**
     * Kat tindakan related to this rekam via the detail_rekam_medis pivot table.
     * Returns a Collection of kat_tindakan models so view can call collection helpers.
     */
    public function katTindakan()
    {
        return $this->belongsToMany(kat_tindakan::class, 'idkode_tindakan_terapi', 'idkode_tindakan_terapi');
    }

    public function dokter()
    {
        return $this->belongsTo(RoleUser::class, 'dokter_pemeriksa', 'idrole_user');
    }

    public function temudokter()
    {
        return $this->belongsTo(Temu_dokter::class, 'idreservasi_dokter', 'idreservasi_dokter');
    }
    
}
