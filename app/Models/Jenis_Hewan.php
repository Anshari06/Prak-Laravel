<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis_Hewan extends Model
{
    protected $table = 'jenis_hewan';
    protected $primaryKey = 'idjenis_hewan';
    protected $fillable = [
        'nama_jenis_hewan'
    ];
    public $timestamps = false;

    public function ras_hewan()
    {
        return $this->hasMany(Ras_Hewan::class, 'idjenis_hewan', 'idjenis_hewan');
    }
}
