<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;

class ResepsionisController extends Controller
{
    public function index()
    {
        return view('resepsionis.index');
    }

    public function regisPet()
    {
        $pets = Pet::all();
        return view('resepsionis.registrasi.regis-pet', compact('pets'));
    }
}
