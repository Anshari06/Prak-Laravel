<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pet';

    protected $fillable = [
        'name',
        'age',
        'idras_hewan',
        'description',
    ];

    public function rasHewan()
    {
        return $this->belongsTo(ras_hewan::class, 'id_ras_hewan');
    }
}
