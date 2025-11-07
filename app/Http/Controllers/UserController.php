<?php

namespace App\Http\Controllers;

use App\Models\RoleUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected function formatName($name)
    {
        return trim(ucwords(strtolower($name)));
    }

    public function stored(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,email',
            'password' => 'required|confirmed',
        ]);
        
        $user = User::create([
            'nama' => $this->formatName($validated['name']),
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        RoleUser::create([
            'iduser' => $user->iduser,
            'idrole' => $validated['idrole'],
        ]);


        return redirect()->route('admin.manage_user')->with('success', 'User berhasil dibuat.');
    }
}
