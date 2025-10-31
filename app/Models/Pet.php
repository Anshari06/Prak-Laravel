<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'idpet';

    protected $fillable = [
        'name',
        'age',
        'idras_hewan',
        'description',
    ];

    public function ras_hewan()
    {
        return $this->belongsTo(Ras_Hewan::class, 'idras_hewan', 'idras_hewan');
    }

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }
}
