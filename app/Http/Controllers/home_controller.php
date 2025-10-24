<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class home_controller extends Controller
{
    public function index()
    {
        return view('Home_RSPH');
    }

    public function struktur()
    {
        return view('struktur');
    }

    
}
