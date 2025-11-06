<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;

class DokterControll extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::all();
        return view('Dokter.index');
    }
}
