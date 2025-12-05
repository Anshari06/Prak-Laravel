<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detailRekam extends Model
{
    protected $table = 'detail_rekam_medis';
    protected $primaryKey = 'iddetail_rekam_medis';

    public $timestamps = false;

    protected $fillable = [
        'idrekam_medis',
        'idkode_tindakan_terapi',
        'detail',
    ];

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }
    
    public function katTindakan()
    {
        return $this->hasMany(kat_tindakan::class, 'idkode_tindakan_terapi', 'idkode_tindakan_terapi');
    }

    public function temudokter()
    {
        return $this->belongsTo(User::class, 'dokter_pemeriksa', 'idrole_user');
    }
}
