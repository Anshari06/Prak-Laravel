<?php

namespace App\Http\Controllers;

use App\Helper\customHelp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Perawat;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Role;
use PHPUnit\TextUI\Help;
use Symfony\Component\Console\Helper\Helper;

class PerawatController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:user,email',
            'nama_perawat' => 'required|string|max:255',
            'password' => 'required',
            'alamat' => 'required|string|max:500',
            'no_wa' => 'required|integer|max:18',
            'pendidikan' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        try {
            DB::beginTransaction();

            // create user record
            $user = User::create([
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'nama' => customHelp::formatName($validatedData['nama_perawat']),
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

    public function show($id)
    {
        $perawat = DB::table('perawat')
            ->join('user', 'perawat.id_user', '=', 'user.iduser')
            ->where('perawat.id_perawat', $id)
            ->select('perawat.*', 'user.nama', 'user.email')
            ->first();

        if (!$perawat) {
            return redirect()->route('admin.perawat.manage_perawat')->with('error', 'Perawat tidak ditemukan.');
        }

        return view('admin.perawat.show', compact('perawat'));
    }

    public function edit($id)
    {
        $perawat = DB::table('perawat')
            ->join('user', 'perawat.id_user', '=', 'user.iduser')
            ->where('perawat.id_perawat', $id)
            ->select('perawat.*', 'user.nama', 'user.email')
            ->first();

        if (!$perawat) {
            return redirect()->route('admin.perawat.manage_perawat')->with('error', 'Perawat tidak ditemukan.');
        }

        return view('admin.perawat.edit', compact('perawat'));
    }

    public function update(Request $request, $id)
    {
        $perawat = Perawat::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string|max:500',
            'no_wa' => 'required|string|max:15',
            'pendidikan' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        try {
            DB::beginTransaction();

            // Update user
            DB::table('user')->where('iduser', $perawat->id_user)->update([
                'nama' => customHelp::formatName($validatedData['nama']),
                'email' => $validatedData['email'],
            ]);

            // Update perawat
            $perawat->update([
                'alamat' => $validatedData['alamat'],
                'no_hp' => $validatedData['no_wa'],
                'pendidikan' => $validatedData['pendidikan'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
            ]);

            DB::commit();

            return redirect()->route('admin.perawat.show_perawat', $id)->with('success', 'Perawat berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate perawat: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $perawat = Perawat::findOrFail($id);
            $userId = $perawat->id_user;

            DB::beginTransaction();

            // Delete perawat record
            $perawat->delete();

            // Delete role_user records
            RoleUser::where('iduser', $userId)->delete();

            // Delete user
            User::where('iduser', $userId)->delete();

            DB::commit();

            return redirect()->route('admin.perawat.manage_perawat')->with('success', 'Perawat berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus perawat: ' . $e->getMessage());
        }
    }
}
