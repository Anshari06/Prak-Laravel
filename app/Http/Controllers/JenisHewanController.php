<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis_Hewan;

class JenisHewanController extends Controller
{
    public function index()
    {
        $jenisHewans = Jenis_Hewan::all();
        return view('admin.jenis_hewan.index', compact('jenisHewans'));
    }
}

