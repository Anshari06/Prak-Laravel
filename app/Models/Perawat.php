<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perawat extends Model
{
    protected $table = 'perawat';
    protected $primaryKey = 'id_perawat';
    protected $fillable = [
        'no_hp',
        'pendidikan',
        'jenis_kelamin',
        'alamat',
        'id_user',
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'iduser');
    }
}
