<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Temu_dokter;
use App\Models\Pemilik;

class ResepsionisController extends Controller
{
    public function index()
    {
        $temuCount = Temu_dokter::count();
        $PemilikCount = Pemilik::count();
        $temuStatus = Temu_dokter::where('status', 'P')->count();
        return view('resepsionis.index', compact('temuCount', 'PemilikCount', 'temuStatus'));
    }

    public function regisPet()
    {
        $pets = Pet::all();
        $pemiliks = Pemilik::with('user')->get();
        $ras = \App\Models\ras_hewan::all();
        return view('resepsionis.registrasi.regis-pet', compact('pets', 'pemiliks', 'ras'));
    }

    public function storePet(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'warna_tanda' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:J,B',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        ]);
        
        $pet = Pet::create([
            'nama' => $validated['nama'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'warna_tanda' => $validated['warna_tanda'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'idpemilik' => $validated['idpemilik'],
            'idras_hewan' => $validated['idras_hewan'],
        ]);

        return redirect()->route('resepsionis.regis-pet')->with('success', 'Pet berhasil didaftarkan.');
    }
}
