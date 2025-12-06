@extends('layouts.admin')

@section('title', 'Edit Temu Dokter')
@section('page-heading', 'Edit Temu Dokter')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Form Edit Temu Dokter</h5>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('resepsionis.temu.update', $temu->idreservasi_dokter) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')

                <div class="col-md-6">
                    <label for="idpet" class="form-label small">Pet</label>
                    <select id="idpet" name="idpet" class="form-select @error('idpet') is-invalid @enderror" required>
                        <option value="">-- Pilih Pet --</option>
                        @foreach ($pets as $pet)
                            <option value="{{ $pet->idpet }}" {{ old('idpet', $temu->idpet) == $pet->idpet ? 'selected' : '' }}>
                                {{ $pet->nama }} ({{ $pet->pemilik->user->nama ?? '-' }})
                            </option>
                        @endforeach
                    </select>
                    @error('idpet')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="idrole_user" class="form-label small">Dokter</label>
                    <select id="idrole_user" name="idrole_user" class="form-select @error('idrole_user') is-invalid @enderror" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach ($dokters as $dokter)
                            <option value="{{ $dokter->idrole_user }}" {{ old('idrole_user', $temu->idrole_user) == $dokter->idrole_user ? 'selected' : '' }}>
                                {{ $dokter->user->nama ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                    @error('idrole_user')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="waktu_daftar" class="form-label small">Waktu Daftar</label>
                    <input type="datetime-local" id="waktu_daftar" name="waktu_daftar"
                        class="form-control @error('waktu_daftar') is-invalid @enderror"
                        value="{{ old('waktu_daftar', \Carbon\Carbon::parse($temu->waktu_daftar)->format('Y-m-d H:i')) }}" required>
                    @error('waktu_daftar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="status" class="form-label small">Status</label>
                    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="P" {{ old('status', $temu->status) == 'P' ? 'selected' : '' }}>Pending (P)</option>
                        <option value="S" {{ old('status', $temu->status) == 'S' ? 'selected' : '' }}>Selesai (S)</option>
                        <option value="C" {{ old('status', $temu->status) == 'C' ? 'selected' : '' }}>Batal (C)</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('resepsionis.temu.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
