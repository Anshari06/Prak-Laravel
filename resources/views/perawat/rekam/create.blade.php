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
                        <label for="idreservasi_dokter" class="form-label">Reservasi Dokter <span
                                class="text-danger">*</span></label>
                        <select name="idreservasi_dokter" id="idreservasi_dokter"
                            class="form-select @error('idreservasi_dokter') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Reservasi --</option>
                            @if (isset($temus) && $temus->isNotEmpty())
                                @foreach ($temus as $t)
                                    <option value="{{ $t->idreservasi_dokter }}"
                                        {{ old('idreservasi_dokter') == $t->idreservasi_dokter ? 'selected' : '' }}>
                                        #{{ $t->idreservasi_dokter }} - No.{{ $t->no_urut }} -
                                        {{ $t->waktu_daftar ? \Carbon\Carbon::parse($t->waktu_daftar)->format('d/m/Y H:i') : '-' }}
                                        @if ($t->pet)
                                            | Pet: {{ $t->pet->nama }}
                                        @endif
                                        @if ($t->roleUser && $t->roleUser->user)
                                            | Dokter: {{ $t->roleUser->user->nama }}
                                        @endif
                                        | Status: {{ $t->status }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('idreservasi_dokter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Data Pet dan Dokter akan diambil otomatis dari
                            reservasi yang dipilih</small>
                    </div>

                    <div class="mb-3">
                        <label for="anamnesa" class="form-label">Anamnesa</label>
                        <textarea name="anamnesa" id="anamnesa" class="form-control" rows="3">{{ old('anamnesa') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="temuan_klinis" class="form-label">Temuan Klinis</label>
                        <textarea name="temuan_klinis" id="temuan_klinis" class="form-control" rows="4">{{ old('temuan_klinis') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="diagnosa" class="form-label">Diagnosa</label>
                        <textarea name="diagnosa" id="diagnosa"
                            class="form-control @error('diagnosa') is-invalid @enderror" rows="3">{{ old('diagnosa') }}</textarea>
                        @error('diagnosa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
