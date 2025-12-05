@extends('layouts.admin')

@section('title', 'Registrasi Pemilik')
@section('page-heading', 'Registrasi Pemilik')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Form Registrasi Pemilik</h4>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('resepsionis.regis-pemilik.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label class="form-label">Nama Pemilik</label>
                    <input type="text" name="nama_pemilik" class="form-control"
                        value="{{ old('nama_pemilik') }}" required>
                    @error('nama_pemilik')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">No. WA</label>
                    <input type="text" name="no_wa" class="form-control"
                        value="{{ old('no_wa') }}" required>
                    @error('no_wa')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <button class="btn btn-primary">Simpan Pemilik</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <strong>Data Pemilik</strong>
        </div>
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:70px">#</th>
                        <th>ID Pemilik</th>
                        <th>Nama Pemilik</th>
                        <th>No. WA</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemiliks as $i => $pemilik)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $pemilik->idpemilik ?? ($pemilik->iduser ?? '-') }}</td>
                            <td>{{ $pemilik->user->nama ?? '-' }}</td>
                            <td>{{ $pemilik->no_wa ?? '-' }}</td>
                            <td>{{ $pemilik->alamat ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
