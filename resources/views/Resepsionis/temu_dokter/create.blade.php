@extends('layouts.admin')

@section('title', 'Tambah Temu Dokter')
@section('page-heading', 'Tambah Temu Dokter')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Form Tambah Temu Dokter</h5>
            <small class="text-muted">Isi data temu dokter baru di form berikut.</small>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                </div>
            @endif

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

            <form action="{{ route('resepsionis.temu.store') }}" method="POST" class="row g-3">
                @csrf

                <div class="col-md-6">
                    <label for="idpet" class="form-label small">Pet</label>
                    <select id="idpet" name="idpet"
                        class="form-select @error('idpet') is-invalid @enderror" required>
                        <option value="">-- Pilih Pet --</option>
                        @foreach ($pets as $pet)
                            <option value="{{ $pet->idpet }}"
                                {{ old('idpet') == $pet->idpet ? 'selected' : '' }}>
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
                    <select id="idrole_user" name="idrole_user"
                        class="form-select @error('idrole_user') is-invalid @enderror" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach ($dokters as $dokter)
                            <option value="{{ $dokter->idrole_user }}"
                                {{ old('idrole_user') == $dokter->idrole_user ? 'selected' : '' }}>
                                {{ $dokter->user->nama ?? '-' }} - {{$dokter->status == 1 ? 'Aktif' : 'Tidak Aktif'}}
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
                        value="{{ old('waktu_daftar', now()->format('Y-m-d H:i')) }}" required>
                    @error('waktu_daftar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                    <a href="{{ route('resepsionis.temu.index') }}"
                        class="btn btn-secondary mt-2">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
