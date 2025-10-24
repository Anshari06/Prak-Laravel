<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Auth_Controller extends Controller
{
    public function login()
    {
        return view('login');
    }

    
}
