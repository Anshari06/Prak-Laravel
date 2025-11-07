<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\detailRekam;
use Illuminate\Http\Request;
use App\Models\RekamMedis;

class Perawat extends Controller
{
    public function index()
    {
        $rekam = RekamMedis::all();

        return view('Perawat.index', compact('rekam'));
    }

    public function detail(Request $request)
    {
        $detail = detailRekam::all()->where('idrekam_medis', $request);
        return view('Perawat.detail-rekam', compact('detail'));
    }
}
