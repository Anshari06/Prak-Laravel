<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Dokter;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Role;

class DokterController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:user,email',
            'nama_dokter' => 'required|string|max:255',
            'password' => 'required|string|',
            'no_wa' => 'required|string|max:15',
            'alamat' => 'required|string|max:500',
            'jenis_kelamin' => 'required|in:L,P',
            'bidang_dokter' => 'nullable|string|max:100',
        ]);

        // Wrap all DB writes in a transaction so partial writes don't persist
        try {
            DB::beginTransaction();

            // create user record
            $user = User::create([
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'nama' => $validatedData['nama_dokter'],
            ]);

            // determine role id for dokter (try to find by name, fallback to 2)
            $role = Role::where('idrole', '2')->first();
            $roleId = $role ? $role->idrole : 2;

            RoleUser::create([
                'iduser' => $user->iduser,
                'idrole' => $roleId,
            ]);

            // create dokter profile (map no_wa -> no_hp)
            Dokter::create([
                'alamat' => $validatedData['alamat'],
                'no_hp' => $validatedData['no_wa'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'bidang_dokter' => $validatedData['bidang_dokter'] ?? null,
                'id_user' => $user->iduser,
            ]);

            DB::commit();

            return redirect()->route('admin.dokter.manage_dokter')->with('success', 'Dokter berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            // log error or return message
            return redirect()->back()->with('error', 'Gagal menambahkan dokter: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        // Find the user by ID
        $user = Dokter::find($id);

        if ($user) {
            // Delete the user
            $user->delete();

            return redirect()->route('admin.dokter.manage_dokter')->with('success', 'Dokter berhasil dihapus.');
        } else {
            return redirect()->route('admin.dokter.manage_dokter')->with('error', 'Dokter tidak ditemukan.');
        }
    }
}
