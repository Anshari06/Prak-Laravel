<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temu_dokter extends Model
{
    protected $table = 'temu_dokter';
    protected $primaryKey = 'idreservasi';
    protected $fillable = [
        'id_pemilik',
        'id_dokter',
        'tanggal_temu',
        'waktu_temu',
        'status_temu',
    ];
    public $timestamps = false;

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'id_pemilik', 'idpemilik');
    }

    public function role_user(){
        return $this->belongsTo(RoleUser::class, 'idrole_user', 'idrole_user');
    }
}
