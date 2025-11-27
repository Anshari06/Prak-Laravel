<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Pemilik;
use App\Models\User;
use App\Models\RoleUser;

class PemilikController extends Controller
{

    public function store(Request $request)
    {
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

        return redirect()->route('admin.pemilik.manage_pemilik')->with('success', 'Pemilik berhasil ditambahkan.');
    }
}
