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
        return view('Perawat.rekam.show', compact('rekam'));
    }
    /**
     * Show form to create a new RekamMedis (Perawat).
     */
    public function create()
    {
        $pets = Pet::all();
        // load users that have a role name like 'dokter'
        $doctors = RoleUser::with('user', 'role')
            ->whereHas('role', function ($q) {
                $q->where('nama_role', 'like', '%dokter%');
            })->get();
        
        $temus = Temu_dokter::all();
        return view('Perawat.rekam.create', compact('pets', 'doctors', 'temus'));
    }

    /**
     * Store a new RekamMedis.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'anamnesa' => 'nullable|string|max:2000',
            'temuan_klinis' => 'nullable|string|max:1000',
            'diagnosa' => 'nullable|string|max:1000',
            'tindakan' => 'nullable|string|max:2000',
            'dokter_pemeriksa' => 'nullable|exists:role_user,idrole_user',
            'idreservasi_dokter' => 'nullable|integer',
        ]);

        $rekam = new RekamMedis();
        $rekam->anamnesa = $validated['anamnesa'] ?? null;
        $rekam->idpet = $validated['idpet'];
        $rekam->temuan_klinis = $validated['temuan_klinis'] ?? null;
        $rekam->diagnosa = $validated['diagnosa'] ?? null;
        $rekam->dokter_pemeriksa = $validated['dokter_pemeriksa'] ?? null;
        $rekam->idreservasi_dokter = $validated['idreservasi_dokter'] ?? null;
        $rekam->tindakan = $validated['tindakan'] ?? null;
        $rekam->save();

        return redirect()->route('perawat.rekam')->with('success', 'Rekam medis berhasil dibuat.');
    }

    /**
     * Show the form for editing the RekamMedis.
     */
    public function edit($id)
    {
        $rekam = RekamMedis::with(['pet', 'detailRekams.katTindakan'])->findOrFail($id);
        $pets = Pet::all();
        $tindakans = kat_tindakan::all();
        return view('Perawat.rekam.edit', compact('rekam', 'pets', 'tindakans'));
    }

    /**
     * Update RekamMedis record.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'temuan_klinis' => 'nullable|string|max:1000',
            'diagnosa' => 'nullable|string|max:1000',
            'tindakan' => 'nullable|string|max:2000',
        ]);

        $rekam = RekamMedis::findOrFail($id);
        $rekam->idpet = $validated['idpet'];
        $rekam->temuan_klinis = $validated['temuan_klinis'] ?? $rekam->temuan_klinis;
        $rekam->diagnosa = $validated['diagnosa'] ?? $rekam->diagnosa;
        $rekam->tindakan = $validated['tindakan'] ?? $rekam->tindakan;
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
}
