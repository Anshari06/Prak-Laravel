<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Temu_dokter;
use App\Models\Pemilik as PemilikModel;
use App\Models\RekamMedis;
use App\Models\detailRekam;
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

        $rekamcount = $pets->isNotEmpty()
            ? RekamMedis::whereIn('idpet', $pets->pluck('idpet'))->count()
            : 0;

        // pass pemilik and pets to the view so we can render owner info and pet list
        return view('Pemilik.index', compact('petCount', 'serveCount', 'rekamcount', 'pemilik', 'pets'));
    }

    /**
     * List all pets owned by the logged-in pemilik.
     */
    public function pet()
    {
        $userId = session('user_id') ?? Auth::id();
        $pemilik = PemilikModel::where('iduser', $userId)->first();
        $pets = $pemilik ? $pemilik->pets()->with('ras_hewan.jenisHewan')->get() : collect();

        return view('Pemilik.pet', compact('pemilik', 'pets'));
    }

    /**
     * List all reservations for pets owned by the logged-in pemilik.
     */
    public function reservasi()
    {
        $userId = session('user_id') ?? Auth::id();
        $pemilik = PemilikModel::where('iduser', $userId)->first();
        $pets = $pemilik ? $pemilik->pets()->get() : collect();
        $petIds = $pets->pluck('idpet');

        $reservasis = $petIds->isNotEmpty()
            ? Temu_dokter::with(['pet.ras_hewan.jenisHewan', 'role_user.user'])
            ->whereIn('idpet', $petIds)
            ->orderByDesc('waktu_daftar')
            ->get()
            : collect();

        return view('Pemilik.reservasi', compact('pemilik', 'reservasis', 'pets'));
    }

    /**
     * List all rekam medis entries for pets owned by the logged-in pemilik.
     */
    public function rekam()
    {
        $userId = session('user_id') ?? Auth::id();
        $pemilik = PemilikModel::where('iduser', $userId)->first();
        $pets = $pemilik ? $pemilik->pets()->get() : collect();
        $petIds = $pets->pluck('idpet');

        $rekams = $petIds->isNotEmpty()
            ? RekamMedis::with(['pet.ras_hewan.jenisHewan', 'dokter.user', 'temudokter'])
            ->whereIn('idpet', $petIds)
            ->orderByDesc('created_at')
            ->get()
            : collect();

        return view('Pemilik.rekam', compact('pemilik', 'rekams', 'pets'));
    }

    /**
     * Show a single rekam medis entry belonging to this pemilik's pet.
     */
    public function rekamShow($id)
    {
        $userId = session('user_id') ?? Auth::id();
        $pemilik = PemilikModel::where('iduser', $userId)->first();
        $pets = $pemilik ? $pemilik->pets()->get() : collect();
        $petIds = $pets->pluck('idpet');

        $rekam = RekamMedis::with([
            'pet.ras_hewan.jenisHewan',
            'pet.pemilik.user',
            'dokter.user',
            'temudokter',
        ])->whereIn('idpet', $petIds)
            ->where('idrekam_medis', $id)
            ->firstOrFail();

        $detail = detailRekam::with('katTindakan')
            ->where('idrekam_medis', $rekam->idrekam_medis)
            ->get();

        return view('Pemilik.rekam_show', compact('rekam', 'detail', 'pemilik'));
    }
}
