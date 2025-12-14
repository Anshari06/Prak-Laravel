<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\detailRekam;
use Illuminate\Http\Request;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DokterControll extends Controller
{
    public function index()
    {
        // prefer the role-user pivot id stored in session (idrole_user)
        $roleUserId = session('user_role_id');
        if (empty($roleUserId) && Auth::check()) {
            $roleUserId = optional(optional(Auth::user()->roleUser)[0])->idrole_user ?? null;
        }

        if (empty($roleUserId)) {
            $rekamMedis = collect();
        } else {
            $rekamMedis = RekamMedis::where('dokter_pemeriksa', $roleUserId)->get();
            $totalRekamMedis = $rekamMedis->count();
        }

        return view('Dokter.index', compact('rekamMedis', 'totalRekamMedis'));
    }

    public function rekam()
    {
        // prefer the role-user pivot id stored in session (idrole_user)
        $roleUserId = session('user_role_id');
        if (empty($roleUserId) && Auth::check()) {
            $roleUserId = optional(optional(Auth::user()->roleUser)[0])->idrole_user ?? null;
        }

        if (empty($roleUserId)) {
            $rekamMedis = collect();
        } else {
            $rekamMedis = RekamMedis::where('dokter_pemeriksa', $roleUserId)->get();
        }

        return view('Dokter.rekam.rekam', compact('rekamMedis'));
    }

    public function show($id)
    {
        $rekam = RekamMedis::with([
            'pet.pemilik.user',
            'pet.ras_hewan.jenisHewan',
            'dokter.user',
        ])
            ->first();

        $detail = detailRekam::where('idrekam_medis', $id)
            ->with('katTindakan')
            ->get();

        return view('Dokter.rekam.show', compact('rekam', 'detail'));
    }

    /**
     * Profile pages for Dokter
     */
    public function profileDokter()
    {
        $user = Auth::user();
        return view('Dokter.profile', compact('user'));
    }

    public function editProfileDokter()
    {
        $user = Auth::user();
        return view('Dokter.edit-profile', compact('user'));
    }

    public function updateProfileDokter(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email,' . $user->iduser . ',iduser',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $updateData = [
            'nama' => $validated['nama'],
            'email' => $validated['email'],
        ];
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        User::where('iduser', $user->iduser)->update($updateData);

        return redirect()->route('dokter.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
