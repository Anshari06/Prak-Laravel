<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis_Hewan;

class Jenis_hewan_Controller extends Controller
{
    public function index()
    {
        $jenisHewans = Jenis_Hewan::all();
        return view('admin.jenis_hewan.index');
    }
}
