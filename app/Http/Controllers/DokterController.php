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


    public function show($id)
    {
        $dokter = DB::table('dokter')
            ->join('user', 'dokter.id_user', '=', 'user.iduser')
            ->where('dokter.id_dokter', $id)
            ->select('dokter.*', 'user.nama', 'user.email')
            ->first();

        if (!$dokter) {
            return redirect()->route('admin.dokter.manage_dokter')->with('error', 'Dokter tidak ditemukan.');
        }

        return view('admin.dokter.show', compact('dokter'));
    }

    public function edit($id)
    {
        $dokter = DB::table('dokter')
            ->join('user', 'dokter.id_user', '=', 'user.iduser')
            ->where('dokter.id_dokter', $id)
            ->select('dokter.*', 'user.nama', 'user.email')
            ->first();

        if (!$dokter) {
            return redirect()->route('admin.dokter.manage_dokter')->with('error', 'Dokter tidak ditemukan.');
        }

        return view('admin.dokter.edit', compact('dokter'));
    }

    public function update(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string|max:100',
            'no_wa' => 'required|string|max:50',
            'bidang_dokter' => 'nullable|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        try {
            DB::beginTransaction();

            // Update user
            DB::table('user')->where('iduser', $dokter->id_user)->update([
                'nama' => $validatedData['nama'],
                'email' => $validatedData['email'],
            ]);

            // Update dokter
            $dokter->update([
                'alamat' => $validatedData['alamat'],
                'no_hp' => $validatedData['no_wa'],
                'bidang_dokter' => $validatedData['bidang_dokter'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
            ]);

            DB::commit();

            return redirect()->route('admin.dokter.show_dokter', $id)->with('success', 'Dokter berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate dokter: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $dokter = Dokter::findOrFail($id);
            $userId = $dokter->id_user;

            DB::beginTransaction();

            // Delete dokter record
            $dokter->delete();

            // Delete role_user records
            RoleUser::where('iduser', $userId)->delete();

            // Delete user
            User::where('iduser', $userId)->delete();

            DB::commit();

            return redirect()->route('admin.dokter.manage_dokter')->with('success', 'Dokter berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus dokter: ' . $e->getMessage());
        }
    }
}
