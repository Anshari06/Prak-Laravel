<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\detailRekam;
use Illuminate\Http\Request;
use App\Models\RekamMedis;
use App\Models\Pet;
use App\Models\RoleUser;
use App\Models\kat_tindakan;
use App\Models\Temu_dokter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Perawat extends Controller
{
    public function index()
    {
        $rekam = RekamMedis::all();
        $count = $rekam->count();

        return view('Perawat.index', compact('rekam', 'count'));
    }

    public function rekam()
    {
        $rekam = RekamMedis::all();
        return view('Perawat.rekam.rekam', compact('rekam'));
    }

    public function show($id)
    {
        $rekam = RekamMedis::with([
            'pet.pemilik.user',
            'pet.ras_hewan.jenisHewan',
            'dokter.user',
        ])
            ->first();
        $id = is_numeric($id) ? $id : null;
        $rekam = RekamMedis::with(['pet', 'detailRekams.katTindakan'])->findOrFail($id);
        $detail = detailRekam::where('idrekam_medis', $id)->get();
        return view('Perawat.rekam.show', compact('rekam', 'detail'));
    }
    /**
     * Show form to create a new RekamMedis (Perawat).
     */
    public function create()
    {
        // Load reservasi dengan relasi pet dan dokter
        $temus = Temu_dokter::with('pet', 'role_user.user')->get();
        return view('Perawat.rekam.create', compact('temus'));
    }

    /**
     * Store a new RekamMedis.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idreservasi_dokter' => 'required|exists:temu_dokter,idreservasi_dokter',
            'anamnesa' => 'nullable|string|max:1000',
            'temuan_klinis' => 'nullable|string|max:1000',
            'diagnosa' => 'nullable|string|max:1000',
        ]);

        // Ambil data dari reservasi
        $reservasi = Temu_dokter::findOrFail($validated['idreservasi_dokter']);

        $rekam = new RekamMedis();
        $rekam->idreservasi_dokter = $validated['idreservasi_dokter'];
        $rekam->idpet = $reservasi->idpet; // Ambil dari reservasi
        $rekam->dokter_pemeriksa = $reservasi->idrole_user; // Ambil dari reservasi
        $rekam->anamnesa = $validated['anamnesa'] ?? null;
        $rekam->temuan_klinis = $validated['temuan_klinis'] ?? null;
        $rekam->diagnosa = $validated['diagnosa'] ?? null;
        $rekam->created_at = now();
        $rekam->save();

        return redirect()->route('perawat.rekam')->with('success', 'Rekam medis berhasil dibuat.');
    }

    /**
     * Show the form for editing the RekamMedis.
     */
    public function edit($id)
    {
        $rekam = RekamMedis::with(['detailRekams.katTindakan'])->findOrFail($id);
        // $pets = Pet::all();
        $tindakans = kat_tindakan::all();
        return view('Perawat.rekam.edit', compact('rekam', 'tindakans'));
    }

    /**
     * Update RekamMedis record.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'anamnesa' => 'nullable|string|max:1000',
            'temuan_klinis' => 'nullable|string|max:1000',
            'diagnosa' => 'nullable|string|max:1000',
        ]);

        $rekam = RekamMedis::findOrFail($id);
        $rekam->anamnesa = $validated['anamnesa'] ?? $rekam->anamnesa;
        $rekam->temuan_klinis = $validated['temuan_klinis'] ?? $rekam->temuan_klinis;
        $rekam->diagnosa = $validated['diagnosa'] ?? $rekam->diagnosa;
        $rekam->save();

        // Handle existing detail items (update or delete)
        $existing = $request->input('existing_details', []);
        if (is_array($existing)) {
            foreach ($existing as $iddetail => $data) {
                // If marked for deletion
                if (!empty($data['_delete'])) {
                    detailRekam::where('iddetail_rekam_medis', $iddetail)->delete();
                    continue;
                }

                $detail = detailRekam::where('iddetail_rekam_medis', $iddetail)->first();
                if ($detail) {
                    $detail->detail = $data['detail'] ?? $detail->detail;
                    if (isset($data['idkode_tindakan_terapi']) && !empty($data['idkode_tindakan_terapi'])) {
                        $detail->idkode_tindakan_terapi = $data['idkode_tindakan_terapi'];
                    }
                    $detail->save();
                }
            }
        }

        // Handle new detail items
        $new = $request->input('new_details', []);
        if (is_array($new)) {
            foreach ($new as $ndata) {
                if (empty($ndata['detail']) && empty($ndata['idkode_tindakan_terapi'])) {
                    continue; // skip empty rows
                }
                detailRekam::create([
                    'idrekam_medis' => $rekam->idrekam_medis,
                    'idkode_tindakan_terapi' => $ndata['idkode_tindakan_terapi'] ?? null,
                    'detail' => $ndata['detail'] ?? null,
                ]);
            }
        }

        return redirect()->route('perawat.rekam.show', $rekam->idrekam_medis)->with('success', 'Rekam medis diperbarui.');
    }

    /**
     * Profile pages for Perawat
     */
    public function profilePerawat()
    {
        $user = Auth::user();
        return view('Perawat.profile', compact('user'));
    }

    public function editProfilePerawat()
    {
        $user = Auth::user();
        return view('Perawat.edit-profile', compact('user'));
    }

    public function updateProfilePerawat(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email,' . $user->iduser . ',iduser',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $updateData = [
            'nama' => $validated['nama'],
            'email' => $validated['email'],
        ];
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        User::where('iduser', $user->iduser)->update($updateData);

        return redirect()->route('perawat.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
