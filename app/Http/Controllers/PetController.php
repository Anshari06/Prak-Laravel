<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pet;
use App\Models\RasHewan;

class PetController extends Controller
{
    public function show($id)
    {
        $pet = DB::table('pet')
            ->leftJoin('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->leftJoin('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->leftJoin('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->leftJoin('user', 'pemilik.iduser', '=', 'user.iduser')
            ->where('pet.idpet', $id)
            ->select('pet.*', 'ras_hewan.nama_ras', 'jenis_hewan.nama_jenis_hewan', 'user.nama as pemilik_nama', 'pemilik.idpemilik')
            ->first();

        if (!$pet) {
            return redirect()->route('admin.pet.manage_pet')->with('error', 'Hewan tidak ditemukan.');
        }

        return view('admin.Pet.show', compact('pet'));
    }

    public function edit($id)
    {
        $pet = DB::table('pet')
            ->leftJoin('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->leftJoin('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->where('pet.idpet', $id)
            ->select('pet.*', 'ras_hewan.idras_hewan', 'ras_hewan.nama_ras', 'jenis_hewan.idjenis_hewan', 'jenis_hewan.nama_jenis_hewan')
            ->first();

        if (!$pet) {
            return redirect()->route('admin.pet.manage_pet')->with('error', 'Hewan tidak ditemukan.');
        }

        // Get all available breeds
        $rasHewan = DB::table('ras_hewan')->get();

        return view('admin.Pet.edit', compact('pet', 'rasHewan'));
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
            'jenis_kelamin' => 'required|in:J,B',
            'tanggal_lahir' => 'nullable|date',
            'warna_tanda' => 'nullable|string|max:45',
        ]);

        $pet->update($validatedData);

        return redirect()->route('admin.pet.show_pet', $id)->with('success', 'Hewan berhasil diupdate.');
    }

    public function destroy($id)
    {
        try {
            $pet = Pet::findOrFail($id);
            $pet->delete();

            return redirect()->route('admin.pet.manage_pet')->with('success', 'Hewan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus hewan: ' . $e->getMessage());
        }
    }
}
