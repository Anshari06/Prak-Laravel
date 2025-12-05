<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temu_dokter extends Model
{
    protected $table = 'temu_dokter';
    protected $primaryKey = 'idreservasi_dokter';
    protected $fillable = [
        'idpet',
        'no_urut',
        'idrole_user',
        'status',
        'waktu_daftar',
    ];
    public $timestamps = false;

    public function pemilik()
    {
        return $this->belongsToMany(Pemilik::class, 'id_pemilik', 'idpemilik');
    }

    public function role_user(){
        return $this->belongsTo(RoleUser::class, 'idrole_user', 'idrole_user');
    }

    public function rekam_medis()
    {
        return $this->hasMany(RekamMedis::class, 'idreservasi_dokter', 'idreservasi');
    }

    public function pet()
    {
        // A reservation belongs to a single pet (if your schema stores `idpet` on `temu_dokter`)
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }
}
