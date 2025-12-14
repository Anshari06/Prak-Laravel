@extends('layouts.admin')

@section('title', 'Edit Rekam Medis')
@section('page-heading', 'Edit Rekam Medis')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Edit Rekam Medis</strong>
                <a href="{{ route('perawat.rekam.show', $rekam->idrekam_medis) }}"
                    class="btn btn-sm btn-secondary">Batal</a>
            </div>
            <div class="card-body">
                <form action="{{ route('perawat.rekam.update', $rekam->idrekam_medis) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- <div class="mb-3">
                        <label for="idpet" class="form-label">Pilih Pet</label>
                        <select name="idpet" id="idpet" class="form-select" required>
                            @foreach ($pets as $pet)
                                <option value="{{ $pet->idpet }}"
                                    {{ $rekam->idpet == $pet->idpet ? 'selected' : '' }}>
                                    {{ $pet->nama }} ({{ optional($pet->pemilik)->nama ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="mb-3">
                        <label for="temuan_klinis" class="form-label">Temuan Klinis</label>
                        <textarea name="temuan_klinis" id="temuan_klinis" class="form-control" rows="4">{{ old('temuan_klinis', $rekam->temuan_klinis) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="diagnosa" class="form-label">Diagnosa</label>
                        <textarea name="diagnosa" id="diagnosa" class="form-control" rows="3">{{ old('diagnosa', $rekam->diagnosa) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="anamnesa" class="form-label">Anamnesa</label>
                        <textarea name="anamnesa" id="anamnesa" class="form-control" rows="3">{{ old('anamnesa', $rekam->anamnesa) }}</textarea>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Detail</label>
                        <textarea name="existing_details[{{ $d->iddetail_rekam_medis }}][detail]" class="form-control" rows="2">{{ old('existing_details.'.$d->iddetail_rekam_medis.'.detail', $d->detail) }}</textarea>
                    </div>
                    
                    <hr>
                    <h5>Detail Tindakan (Rinci)</h5>

                    {{-- Existing detail items --}}
                    <div id="existing-details" class="mb-3">
                        @if($rekam->detailRekams && $rekam->detailRekams->isNotEmpty())
                            @foreach($rekam->detailRekams as $d)
                                <div class="card mb-2 p-2 existing-detail-row" data-id="{{ $d->iddetail_rekam_medis }}">
                                    <input type="hidden" name="existing_details[{{ $d->iddetail_rekam_medis }}][id]" value="{{ $d->iddetail_rekam_medis }}">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="form-label">Kategori Tindakan</label>
                                            <select name="existing_details[{{ $d->iddetail_rekam_medis }}][idkode_tindakan_terapi]" class="form-select">
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach($tindakans as $t)
                                                    <option value="{{ $t->idkode_tindakan_terapi }}" {{ $d->idkode_tindakan_terapi == $t->idkode_tindakan_terapi ? 'selected' : '' }}>{{ $t->deskripsi_tindakan_terapi }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-1 d-flex align-items-start">
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="existing_details[{{ $d->iddetail_rekam_medis }}][_delete]" id="del_{{ $d->iddetail_rekam_medis }}" value="1">
                                                <label class="form-check-label small text-danger" for="del_{{ $d->iddetail_rekam_medis }}">Hapus</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="mb-2">Belum ada detail tindakan.</div>
                        @endif
                    </div>

                    {{-- Container for new detail rows added dynamically --}}
                    <div id="new-details" class="mb-3"></div>

                    <button type="button" id="add-detail" class="btn btn-sm btn-outline-primary mb-3">+ Tambah Detail Baru</button>

                    <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Simple JS to add/remove new detail rows
        (function(){
            const addBtn = document.getElementById('add-detail');
            const newContainer = document.getElementById('new-details');
            let newIndex = 0;

            function makeRow(idx) {
                const wrapper = document.createElement('div');
                wrapper.className = 'card mb-2 p-2 new-detail-row';
                wrapper.innerHTML = `
                    <div class="row">
                        <div class="col-md-5">
                            <label class="form-label">Kategori Tindakan</label>
                            <select name="new_details[${idx}][idkode_tindakan_terapi]" class="form-select">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($tindakans as $t)
                                    <option value="{{ $t->idkode_tindakan_terapi }}">{{ addslashes($t->deskripsi_tindakan_terapi) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Detail</label>
                            <textarea name="new_details[${idx}][detail]" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-md-1 d-flex align-items-start">
                            <button type="button" class="btn btn-sm btn-danger remove-new">Hapus</button>
                        </div>
                    </div>
                `;
                return wrapper;
            }

            if (addBtn) {
                addBtn.addEventListener('click', function(){
                    const row = makeRow(newIndex++);
                    newContainer.appendChild(row);
                    row.querySelector('.remove-new').addEventListener('click', function(){ row.remove(); });
                });
            }

            // attach remove handlers for any pre-existing remove buttons (if added server-side)
            document.querySelectorAll('.remove-new').forEach(btn => btn.addEventListener('click', function(){ btn.closest('.new-detail-row').remove(); }));
        })();
    </script>
@endsection
