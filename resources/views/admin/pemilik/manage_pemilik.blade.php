@extends('layouts.admin')

@section('title', 'Manage Pemilik')
@section('page-heading', 'Manage Pemilik')

@section('content')
    <div class="container-fluid p-0">
        <h2 class="mt-0 mb-2">Welcome</h2>
        <p class="mb-3">Your data is right here</p>

        <div class="card mb-4">
             <div class="card-header">
                            <h5 class="mb-0">Form Tambah Pemilik</h5>
                            <small class="text-muted">Isi data pemilik baru di form berikut.</small>
                        </div>
            <div class="card-body">
                <div class="card-shadow">
                    <form action=" {{ route ('admin.add_user')}} " method="POST" class="row g-3">
                        @csrf

                        <div class="col-md-3">
                            <label for="iduser" class="form-label small">ID User</label>
                            <input type="number" id="iduser"
                                class="form-control @error('iduser') is-invalid @enderror"
                                name="iduser" placeholder="ID User" value="{{ old('iduser') }}">
                            @error('iduser')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="nama" class="form-label small">Nama Pemilik</label>
                            <input type="text" id="nama"
                                class="form-control @error('nama') is-invalid @enderror" name="nama"
                                placeholder="Nama lengkap" value="{{ old('nama') }}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="no_wa" class="form-label small">No. WA</label>
                            <input type="text" id="no_wa"
                                class="form-control @error('no_wa') is-invalid @enderror" name="no_wa"
                                placeholder="0812xxxx" value="{{ old('no_wa') }}">
                            @error('no_wa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-9">
                            <label for="alamat" class="form-label small">Alamat</label>
                            <input type="text" id="alamat"
                                class="form-control @error('alamat') is-invalid @enderror"
                                name="alamat" placeholder="Alamat lengkap" value="{{ old('alamat') }}">
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary mt-2">Add Pemilik</button>
                        </div>
                    </form>
                </div>
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
                            <th>Aksi</th>
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
                                <td>
                                    <div class="d-grid gap-2 d-md-block">
                                        <a href="#" class="btn btn-sm btn-info p-1 px-2"
                                            title="Lihat"><i class="bi bi-eye fs-6"></i></a>
                                        <a href="#" class="btn btn-sm btn-warning p-1 px-2"
                                            title="Edit"><i class="bi bi-pencil fs-6"></i></a>
                                        <form method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus pemilik ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-danger p-1 px-2" title="Hapus"><i
                                                    class="bi bi-trash fs-6"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
