<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
    protected $primaryKey = 'idrole_user';
    public $timestamps = false;

    protected $fillable = [
        'idrole',
        'iduser',
        'status',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }

    public function Rekam()
    {
        return $this->hasOne(RekamMedis::class, 'idrole_user', 'dokter_pemeriksa');
    }
}
