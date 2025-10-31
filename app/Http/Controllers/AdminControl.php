<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jenis_Hewan;
use App\Models\ras_hewan;

class AdminControl extends Controller
{
    public function index()
    {
        // Load users so the admin dashboard can display the users table
        $users = User::all();
        $usersCount = User::count();
        $jenisCount = Jenis_Hewan::count();
        $hewancount = ras_hewan::count();


        return view('admin.index', compact('users', 'usersCount', 'jenisCount', 'hewancount'));
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('admin.manage_user', compact('users'));
    }
}
