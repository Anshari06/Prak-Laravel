<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Perawat;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Role;

class PerawatController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:user,email',
            'nama_perawat' => 'required|string|max:255',
            'password' => 'required',
            'alamat' => 'required|string|max:500',
            'no_wa' => 'required|string|max:15',
            'pendidikan' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        try {
            DB::beginTransaction();

            // create user record
            $user = User::create([
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'nama' => $validatedData['nama_perawat'],
            ]);

            // assign role id for perawat
            $role = Role::where('idrole', '3')->first();
            $roleId = $role ? $role->idrole : 3;
            RoleUser::create([
                'iduser' => $user->iduser,
                'idrole' => $roleId,
            ]);
            // create perawat profile
            Perawat::create([
                'no_hp' => $validatedData['no_wa'],
                'pendidikan' => $validatedData['pendidikan'] ?? null,
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'alamat' => $validatedData['alamat'],
                'id_user' => $user->iduser,
            ]);

            DB::commit();

            return redirect()->route('admin.perawat.manage_perawat')->with('success', 'Perawat berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambahkan perawat: ' . $e->getMessage());
        }
    }
}
