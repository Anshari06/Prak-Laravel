<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use App\Models\Jenis_Hewan;
use App\Models\Pet;
// use App\Models\ras_hewan;

class AdminControl extends Controller
{
    public function index()
    {
        // Load users so the admin dashboard can display the users table (5 newest)
        $users = User::latest()->limit(5)->get();
        $usersCount = User::count();
        $petCount = Pet::count();


        return view('admin.index', compact('users', 'usersCount', 'petCount'));
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('admin.manage_user', compact('users'));
    }
}
