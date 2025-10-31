<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use App\Models\Jenis_Hewan;
use App\Models\Pet;
// use App\Models\ras_hewan;
use App\Models\Pemilik;

class AdminControl extends Controller
{
    public function index()
    {
        // Load users so the admin dashboard can display the users table (5 newest)
        // The table does not have `created_at`, so order by primary key `iduser` instead.
        $users = User::orderBy('iduser', 'desc')->limit(5)->get();

        // count total data
        $usersCount = User::count();
        $petCount = Pet::count();
        $pemilikCount = Pemilik::count();



        return view('admin.index', compact('users', 'usersCount', 'petCount'));
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('admin.user.manage_user', compact('users'));
    }
}
