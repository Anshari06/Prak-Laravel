<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Temu_dokter;
use App\Models\Pemilik;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ResepsionisController extends Controller
{
    public function index()
    {
        $TemuCount = Temu_dokter::count();
        $PemilikCount = Pemilik::count();
        $temuStatus = Temu_dokter::where('status', 'P')->count();
        return view('resepsionis.index', compact('TemuCount', 'PemilikCount', 'temuStatus'));
    }

    public function regisPet()
    {
        $pets = Pet::all();
        $pemiliks = Pemilik::with('user')->get();
        $ras = \App\Models\ras_hewan::all();
        return view('resepsionis.registrasi.regis-pet', compact('pets', 'pemiliks', 'ras'));
    }

    public function regisPemilik()
    {
        $pemiliks = Pemilik::with('user')->get();
        return view('resepsionis.registrasi.regis-pemilik', compact('pemiliks'));
    }

    public function temuDokter()
    {
        // load reservations ordered by waktu_daftar
        $temus = Temu_dokter::with(['pet', 'role_user.user'])->orderBy('idreservasi_dokter')->get();
        return view('resepsionis.temu_dokter.index', compact('temus'));
    }

    public function createTemuDokter()
    {
        $pets = Pet::with('pemilik.user')->get();
        $dokters = RoleUser::with('user')
            ->where('idrole', 2)  // role 2 = dokter
            ->get();
        return view('resepsionis.temu_dokter.create', compact('pets', 'dokters'));
    }

    public function storeTemuDokter(Request $request)
    {
        $validatedData = $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
            'waktu_daftar' => 'required|date_format:Y-m-d\TH:i',
        ]);

        // Convert datetime-local format (Y-m-d\TH:i) to Y-m-d H:i
        $waktuDaftar = str_replace('T', ' ', $validatedData['waktu_daftar']);

        // Get the date part only
        $date = substr($waktuDaftar, 0, 10);

        // Count how many reservations exist for this date
        $countForDay = Temu_dokter::whereRaw("DATE(waktu_daftar) = ?", [$date])->count();

        // Next no_urut is count + 1
        $no_urut = $countForDay + 1;

        // Create the reservation
        $temu = Temu_dokter::create([
            'idpet' => $validatedData['idpet'],
            'idrole_user' => $validatedData['idrole_user'],
            'waktu_daftar' => $waktuDaftar,
            'no_urut' => $no_urut,
            'status' => 'P',
        ]);

        // Format nomor urut: YYYYMMDD-{no_urut}
        $nomorUrut = Carbon::parse($waktuDaftar)->format('Ymd') . '-' . $no_urut;

        return redirect()->route('resepsionis.temu.success', ['id' => $temu->idreservasi_dokter])->with('nomorUrut', $nomorUrut);
    }

    public function successTemuDokter($id)
    {
        $temu = Temu_dokter::with(['pet.pemilik.user', 'role_user.user'])->find($id);

        if (!$temu) {
            return redirect()->route('resepsionis.temu.index')->with('error', 'Data temu dokter tidak ditemukan.');
        }

        // Format nomor urut: YYYYMMDD-{no_urut}
        $nomorUrut = Carbon::parse($temu->waktu_daftar)->format('Ymd') . '-' . $temu->no_urut;

        return view('resepsionis.temu_dokter.success', compact('temu', 'nomorUrut'));
    }

    public function storePemilik(Request $request)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'email' => 'required|email|unique:user,email',
                'nama_pemilik' => 'required|string|max:255',
                'password' => 'required|string',
                'alamat' => 'required|string|max:500',
                'no_wa' => 'required|string|max:15',
            ]);

            // Create user
            $user = User::create([
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'nama' => $validatedData['nama_pemilik'],
            ]);

            // Assign role (use RoleUser model)
            RoleUser::create([
                'iduser' => $user->iduser,
                'idrole' => 5,
            ]);

            // Create pemilik record
            Pemilik::create([
                'alamat' => $validatedData['alamat'],
                'no_wa' => $validatedData['no_wa'],
                'iduser' => $user->iduser,
            ]);

            DB::commit();
            return redirect()->route('resepsionis.regis-pemilik')->with('success', 'Pemilik berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Terjadi kesalahan saat menyimpan data pemilik: ' . $e->getMessage())->withInput();
        }
    }

    public function storePet(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'warna_tanda' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:J,B',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        ]);

        $pet = Pet::create([
            'nama' => $validated['nama'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'warna_tanda' => $validated['warna_tanda'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'idpemilik' => $validated['idpemilik'],
            'idras_hewan' => $validated['idras_hewan'],
        ]);

        return redirect()->route('resepsionis.regis-pet')->with('success', 'Pet berhasil didaftarkan.');
    }
}
