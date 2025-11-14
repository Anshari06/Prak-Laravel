<?php

namespace App\Http\Controllers;

use App\Models\RoleUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Helper\customHelp;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function stored(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,email',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'nama' => customHelp::formatName($validated['name']),
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        RoleUser::create([
            'iduser' => $user->iduser,
            'idrole' => $validated['idrole'],
        ]);


        return redirect()->route('admin.manage_user')->with('success', 'User berhasil dibuat.');
    }

    /**
     * Display a single user's details.
     */
    public function show($id)
    {
        // eager-load role pivot and pemilik relation if any
        // Fetch user using query builder
        $user = DB::table('user')->where('iduser', $id)->first();

        // Fetch roles via role_user pivot join
        $roles = DB::table('role_user')
            ->join('role', 'role.idrole', '=', 'role_user.idrole')
            ->where('role_user.iduser', $id)
            ->select('role.nama_role', 'role_user.status')
            ->get();

        // Fetch pemilik record if exists
        $pemilik = DB::table('pemilik')->where('iduser', $id)->first();

        // If pemilik exists, fetch their pets too
        $pets = collect();
        if (!empty($pemilik)) {
            $pets = DB::table('pet')
                ->leftJoin('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
                ->leftJoin('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
                ->where('pet.idpemilik', $pemilik->idpemilik)
                ->select('pet.*', 'ras_hewan.nama_ras as nama_ras', 'jenis_hewan.nama_jenis_hewan as nama_jenis_hewan')
                ->get()
                ->map(function ($p) {
                    $p->display_name = $p->nama ?? $p->name ?? null;
                    return $p;
                });
        }

        return view('admin.user.show', compact('user', 'roles', 'pemilik', 'pets'));
    }
}
