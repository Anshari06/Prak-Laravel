<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Temu_dokter;
use App\Models\Pemilik;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResepsionisController extends Controller
{
    public function index()
    {
        $TemuCount = Temu_dokter::count();
        $PemilikCount = Pemilik::count();
        $temuStatus = Temu_dokter::where('status', 'P')->count();
        return view('resepsionis.index', compact('TemuCount', 'PemilikCount', 'temuStatus'));
    }

    public function regisPet()
    {
        $pets = Pet::all();
        $pemiliks = Pemilik::with('user')->get();
        $ras = \App\Models\ras_hewan::all();
        return view('resepsionis.registrasi.regis-pet', compact('pets', 'pemiliks', 'ras'));
    }

    public function regisPemilik()
    {
        $pemiliks = Pemilik::with('user')->get();
        return view('resepsionis.registrasi.regis-pemilik', compact('pemiliks'));
    }

    public function storePemilik(Request $request)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'email' => 'required|email|unique:user,email',
                'nama_pemilik' => 'required|string|max:255',
                'password' => 'required|string',
                'alamat' => 'required|string|max:500',
                'no_wa' => 'required|string|max:15',
            ]);

            // Create user
            $user = User::create([
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'nama' => $validatedData['nama_pemilik'],
            ]);

            // Assign role (use RoleUser model)
            RoleUser::create([
                'iduser' => $user->iduser,
                'idrole' => 5,
            ]);

            // Create pemilik record
            Pemilik::create([
                'alamat' => $validatedData['alamat'],
                'no_wa' => $validatedData['no_wa'],
                'iduser' => $user->iduser,
            ]);

            DB::commit();
            return redirect()->route('resepsionis.regis-pemilik')->with('success', 'Pemilik berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Terjadi kesalahan saat menyimpan data pemilik: ' . $e->getMessage())->withInput();
        }
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
