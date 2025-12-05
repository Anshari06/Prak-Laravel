@extends('layouts.admin')

@section('title', 'Tambah Rekam Medis')
@section('page-heading', 'Tambah Rekam Medis')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Tambah Rekam Medis</strong>
                <a href="{{ route('perawat.rekam') }}" class="btn btn-sm btn-secondary">Batal</a>
            </div>
            <div class="card-body">
                <form action="{{ route('perawat.rekam.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="idpet" class="form-label">Pilih Pet</label>
                        <select name="idpet" id="idpet" class="form-select" required>
                            <option value="">-- Pilih Pet --</option>
                            @foreach ($pets as $pet)
                                <option value="{{ $pet->idpet }}">{{ $pet->nama }}
                                    ({{ optional($pet->pemilik)->nama ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="anamnesa" class="form-label">Anamnesa</label>
                        <textarea name="anamnesa" id="anamnesa" class="form-control" rows="3">{{ old('anamnesa') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="dokter_pemeriksa" class="form-label">Dokter Pemeriksa</label>
                        <select name="dokter_pemeriksa" id="dokter_pemeriksa" class="form-select">
                            <option value="">-- Pilih Dokter (opsional) --</option>
                            @if (isset($doctors) && $doctors->isNotEmpty())
                                @foreach ($doctors as $doc)
                                    <option value="{{ $doc->idrole_user }}">
                                        {{ optional($doc->user)->nama ?? 'User#' . $doc->iduser }}
                                        ({{ optional($doc->role)->nama_role ?? 'dokter' }})
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="idreservasi_dokter" class="form-label">Reservasi Dokter
                            (opsional)</label>
                        <select name="idreservasi_dokter" id="idreservasi_dokter" class="form-select">
                            <option value="">-- Pilih Reservasi (opsional) --</option>
                            @if (isset($temus) && $temus->isNotEmpty())
                                @foreach ($temus as $t)
                                    <option value="{{ $t->idreservasi_dokter }}">
                                        {{ $t->idreservasi_dokter }} - {{ $t->waktu_daftar ?? '-' }} - {{$t->no_urut}} - {{$t->status}}
                                        @if (optional($t->pet))
                                            -
                                            {{ $t->pet->nama ?? '-'}}
                                        @endif
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="temuan_klinis" class="form-label">Temuan Klinis</label>
                        <textarea name="temuan_klinis" id="temuan_klinis" class="form-control" rows="4">{{ old('temuan_klinis') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="diagnosa" class="form-label">Diagnosa</label>
                        <textarea name="diagnosa" id="diagnosa" class="form-control" rows="3">{{ old('diagnosa') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="tindakan" class="form-label">Tindakan (ringkasan)</label>
                        <textarea name="tindakan" id="tindakan" class="form-control" rows="3">{{ old('tindakan') }}</textarea>
                    </div>

                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
