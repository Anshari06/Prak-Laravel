<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemilik;

class PemilikController extends Controller
{
    public function index()
    {
        $Pemiliks = Pemilik::all();
        return view('admin.pemilik.manage_pemilik', compact('Pemiliks'));
    }
}
