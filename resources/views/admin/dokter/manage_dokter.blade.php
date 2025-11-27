@extends('layouts.admin')

@section('title', 'Manage Dokter')
@section('page-heading', 'Manage Dokter')

@section('content')
    <div class="container-fluid p-0">
        <h2 class="mt-0 mb-2">Manage Dokter</h2>
        <p class="mb-3">Halaman untuk menambah dan melihat daftar dokter.</p>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Form Tambah Dokter</h5>
                <small class="text-muted">Isi data dokter baru di form berikut.</small>
            </div>
            <div class="card-body">
                <div class="card-shadow">
                    <form action=" {{ route('admin.dokter.add_dokter') }} " method="POST"
                        class="row g-3">
                        @csrf

                        <div class="col-md-4">
                            <label for="email" class="form-label small">Email</label>
                            <input type="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                placeholder="email@example.com" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="nama_dokter" class="form-label small">Nama Dokter</label>
                            <input type="text" id="nama_dokter"
                                class="form-control @error('nama_dokter') is-invalid @enderror"
                                name="nama_dokter" placeholder="Nama lengkap"
                                value="{{ old('nama_dokter') }}">
                            @error('nama_dokter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="password" class="form-label small">Password</label>
                            <input type="password" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password" placeholder="Password">
                            @error('password')
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

                        <div class="col-md-3">
                            <label for="jenis_kelamin" class="form-label small">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin"
                                class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="L"
                                    {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="P"
                                    {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-5">
                            <label for="bidang_dokter" class="form-label small">Bidang Dokter</label>
                            <input type="text" id="bidang_dokter"
                                class="form-control @error('bidang_dokter') is-invalid @enderror"
                                name="bidang_dokter" placeholder="Contoh: Bedah, Penyakit Dalam"
                                value="{{ old('bidang_dokter') }}" maxlength="100">
                            @error('bidang_dokter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-9">
                            <label for="alamat" class="form-label small">Alamat</label>
                            <input type="text" id="alamat"
                                class="form-control @error('alamat') is-invalid @enderror"
                                name="alamat" placeholder="Alamat lengkap"
                                value="{{ old('alamat') }}">
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary mt-2">Add Dokter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <strong>Data Dokter</strong>
            </div>
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:70px">#</th>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>No. WA</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokters as $dokter)
                            <tr>
                                <td>{{ $loop -> iteration }}</td>
                                <td>{{ $dokter->id_dokter ?? '-' }}</td>
                                <td>{{ $dokter->user->nama ?? '-' }}</td>
                                <td>{{ $dokter->no_hp ?? '-' }}</td>
                                <td>{{ $dokter->alamat ?? '-' }}</td>
                                <td>
                                    <div class="d-grid gap-2 d-md-block">
                                        <a href="#" class="btn btn-sm btn-info p-1 px-2"
                                            title="Lihat"><i class="bi bi-eye fs-6"></i></a>
                                        <a href="#" class="btn btn-sm btn-warning p-1 px-2"
                                            title="Edit"><i class="bi bi-pencil fs-6"></i></a>
                                        <form method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-danger p-1 px-2"
                                                title="Hapus"><i
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
