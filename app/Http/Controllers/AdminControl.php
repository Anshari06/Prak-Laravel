<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jenis_Hewan;
use App\Models\Kat_Klinis;
use App\Models\kat_tindakan;
use App\Models\Pet;
// use App\Models\ras_hewan;
use App\Models\Pemilik;
use App\Models\Role;
use App\Models\Categories;
use App\Models\ras_hewan;

class AdminControl extends Controller
{
    public function index()
    {
        // Load users so the admin dashboard can display the users table (5 newest)
        // The table does not have `created_at`, so order by primary key `iduser` instead.
        $users = User::orderBy('iduser', 'desc')->limit(5)->get();

        // count total data
        $usersCount = User::count();
        $petCount = Pet::count();
        $pemilikCount = Pemilik::count();

        return view('admin.index', compact('users', 'usersCount', 'petCount', 'pemilikCount'));
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('admin.user.manage_user', compact('users'));
    }

    public function managePemilik()
    {
        $pemiliks = Pemilik::with('user')->get();
        return view('admin.pemilik.manage_pemilik', compact('pemiliks'));
    }

    public function manageJenisHewan()
    {
        $jenisHewans = Jenis_Hewan::all();
        return view('admin.jenis_hewan.manage_jenis_hewan', compact('jenisHewans'));
    }
    public function manageRasHewan()
    {
        $jenisHewans = ras_hewan::with('jenis_Hewan')->get();
        return view('admin.jenis_hewan.manage_jenis_hewan', compact('jenisHewans'));
    }

    public function managePets()
    {
        $pets = Pet::with('ras_hewan', 'pemilik')->get();
        return view('admin.pet.manage_pet', compact('pets'));
    }

    public function manageRoles()
    {
        $roles = Role::all();
        return view('admin.role.manage_role', compact('roles'));
    }

    public function manageKategori()
    {
        $kategoris = Categories::all();
        return view('admin.kategori.manage_kategori', compact('kategoris'));
    }
    public function manageKat_klinis()
    {
        $kliniss = Kat_Klinis::all();
        return view('admin.Klinis.manage_klinis', compact('kliniss'));
    }

    public function manageKat_tindakan()
    {
        $Categories = kat_tindakan::all();
        return view('admin.Tindakan.manage_tindakan', compact('Categories'));
    }

    
}
