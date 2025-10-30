<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminControl extends Controller
{
    public function index()
    {
        // Load users so the admin dashboard can display the users table
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('admin.manage_user', compact('users'));
    }
}
