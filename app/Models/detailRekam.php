<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detailRekam extends Model
{
    protected $table = 'detail_rekam_medis';
    protected $primaryKey = 'iddetail_rekam_medis';

    public $timestamps = false;

    protected $fillable = [
        'anamnesa',
        'temuan_klinis',
        'diagnosa',
    ];
}
