@extends('layouts.admin')

@section('title', 'Edit Pemilik')
@section('page-heading', 'Edit Pemilik')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Form Edit Pemilik</h5>
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

            <form action="{{ route('resepsionis.regis-pemilik.update', $pemilik->idpemilik) }}"
                method="POST" class="row g-3">
                @csrf
                @method('PUT')

                <div class="col-md-6">
                    <label class="form-label">Nama Pemilik</label>
                    <input type="text" name="nama_pemilik"
                        class="form-control @error('nama_pemilik') is-invalid @enderror"
                        value="{{ old('nama_pemilik', $pemilik->user->nama ?? '') }}" required>
                    @error('nama_pemilik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email (Read-only)</label>
                    <input type="email" class="form-control"
                        value="{{ $pemilik->user->email ?? '-' }}" disabled>
                </div>

                <div class="col-md-6">
                    <label class="form-label">No. WA</label>
                    <input type="text" name="no_wa"
                        class="form-control @error('no_wa') is-invalid @enderror"
                        value="{{ old('no_wa', $pemilik->no_wa) }}" required>
                    @error('no_wa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat"
                        class="form-control @error('alamat') is-invalid @enderror"
                        value="{{ old('alamat', $pemilik->alamat) }}" required>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('resepsionis.regis-pemilik') }}"
                        class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
