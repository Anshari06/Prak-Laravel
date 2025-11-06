<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Temu_dokter;
use App\Models\Pemilik as PemilikModel;
use Illuminate\Support\Facades\Auth;


class Pemilik extends Controller
{
    public function index()
    {
        // get current logged-in user's id (iduser)
        $userId = session('user_id') ?? Auth::id();

        // find the pemilik record linked to this user
        $pemilik = PemilikModel::where('iduser', $userId)->first();

        // load pets (with ras and jenis) or an empty collection
        $pets = $pemilik ? $pemilik->pets()->with('ras_hewan.jenisHewan')->get() : collect();

        // compute counts
        $petCount = $pets->count();

        $serveCount = $pets->isNotEmpty()
            ? Temu_dokter::whereIn('idpet', $pets->pluck('idpet'))->count()
            : 0;

        // pass pemilik and pets to the view so we can render owner info and pet list
        return view('Pemilik.index', compact('petCount', 'serveCount', 'pemilik', 'pets'));
    }
}
