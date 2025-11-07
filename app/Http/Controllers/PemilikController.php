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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'iduser' => 'required|integer|unique:pemiliks,iduser',
            'nama_pemilik' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_telp' => 'required|string|max:15',
        ]);
        Pemilik::create($validatedData);
        
        return redirect()->route('admin.manage_pemilik')->with('success', 'Pemilik berhasil ditambahkan.');
    }
}
