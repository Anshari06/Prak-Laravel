<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
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

    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $userId = $pemilik->iduser;

        // Delete pemilik first
        $pemilik->delete();

        // Delete related role_user records
        RoleUser::where('iduser', $userId)->delete();

        // Delete user
        User::where('iduser', $userId)->delete();

        return redirect()->route('admin.pemilik.manage_pemilik')->with('success', 'Pemilik berhasil dihapus.');
    }

    public function show($id)
    {
        $pemilik = DB::table('pemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->where('pemilik.idpemilik', $id)
            ->select('pemilik.*', 'user.nama', 'user.email')
            ->first();

        if (!$pemilik) {
            return redirect()->route('admin.pemilik.manage_pemilik')->with('error', 'Pemilik tidak ditemukan.');
        }

        return view('admin.pemilik.show', compact('pemilik'));
    }

    public function edit($id)
    {
        $pemilik = DB::table('pemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->where('pemilik.idpemilik', $id)
            ->select('pemilik.*', 'user.nama', 'user.email')
            ->first();

        if (!$pemilik) {
            return redirect()->route('admin.pemilik.manage_pemilik')->with('error', 'Pemilik tidak ditemukan.');
        }

        return view('admin.pemilik.edit', compact('pemilik'));
    }

    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string|max:100',
            'no_wa' => 'required|string|max:45',
        ]);

        try {
            DB::beginTransaction();

            // Update user
            DB::table('user')->where('iduser', $pemilik->iduser)->update([
                'nama' => $validatedData['nama'],
                'email' => $validatedData['email'],
            ]);

            // Update pemilik
            $pemilik->update([
                'alamat' => $validatedData['alamat'],
                'no_wa' => $validatedData['no_wa'],
            ]);

            DB::commit();

            return redirect()->route('admin.pemilik.show_pemilik', $id)->with('success', 'Pemilik berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate pemilik: ' . $e->getMessage());
        }
    }
}
