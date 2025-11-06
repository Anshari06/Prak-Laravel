<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Auth;

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
        }

        return view('Dokter.index', compact('rekamMedis'));
    }
}
