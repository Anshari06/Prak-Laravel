<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Pemilik extends Controller
{
    public function index()
    {
        return view('Pemilik.index');
    }
}
