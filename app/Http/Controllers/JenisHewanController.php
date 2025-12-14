<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis_Hewan;
use Illuminate\Support\Facades\DB;
use App\Helper\customHelp;

class JenisHewanController extends Controller
{
    public function index()
    {
        $jenisHewans = Jenis_Hewan::all();
        return view('admin.jenis_hewan.index', compact('jenisHewans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:225|unique:jenis_hewan,nama_jenis_hewan',
        ], [
            'nama_jenis.required' => 'Nama jenis hewan wajib diisi.',
            'nama_jenis.string'   => 'Nama jenis hewan harus berupa teks.',
            'nama_jenis.max'      => 'Nama jenis terlalu panjang, maksimal 225 karakter.',
            'nama_jenis.unique'   => 'Nama jenis ini sudah terdaftar, gunakan nama lain.',
        ]);

        try {
            DB::table('jenis_hewan')->insert([
                'nama_jenis_hewan' => customHelp::formatName($request->nama_jenis),
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menambahkan Jenis Hewan.');
        }


        return redirect()->route('admin.jenis_hewan.manage_jenis_hewan')->with('success', 'Jenis Hewan berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        try {
            DB::table('jenis_hewan')->where('idjenis_hewan', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus Jenis Hewan.');
        }

        return redirect()->route('admin.jenis_hewan.manage_jenis_hewan')->with('success', 'Jenis Hewan berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:225|unique:jenis_hewan,nama_jenis_hewan,' . $id . ',idjenis_hewan',
        ], [
            'nama_jenis.required' => 'Nama jenis hewan wajib diisi.',
            'nama_jenis.string'   => 'Nama jenis hewan harus berupa teks.',
            'nama_jenis.max'      => 'Nama jenis terlalu panjang, maksimal 225 karakter.',
            'nama_jenis.unique'   => 'Nama jenis ini sudah terdaftar, gunakan nama lain.',
        ]);

        try {
            DB::table('jenis_hewan')
                ->where('idjenis_hewan', $id)
                ->update(['nama_jenis_hewan' => customHelp::formatName($request->nama_jenis)]);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui Jenis Hewan.');
        }

        return redirect()->route('admin.jenis_hewan.manage_jenis_hewan')->with('success', 'Jenis Hewan berhasil diperbarui.');
    }
}
