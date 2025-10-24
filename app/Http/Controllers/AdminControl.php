<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminControl extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function manageUsers()
    {
        // Logic for managing users
    }
}
