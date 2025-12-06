@extends('layouts.admin')

@section('title', 'Manage Perawat')
@section('page-heading', 'Manage Perawat')

@section('content')
    <div class="container-fluid p-0">
        <h2 class="mt-0 mb-2">Manage Perawat</h2>
        <p class="mb-3">Halaman untuk menambah dan melihat daftar perawat.</p>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Form Tambah Perawat</h5>
                <small class="text-muted">Isi data perawat baru di form berikut.</small>
            </div>
            <div class="card-body">
                <div class="card-shadow">
                    <form action=" {{ route('admin.perawat.add_perawat') }} " method="POST"
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
                            <label for="nama_perawat" class="form-label small">Nama Perawat</label>
                            <input type="text" id="nama_perawat"
                                class="form-control @error('nama_perawat') is-invalid @enderror"
                                name="nama_perawat" placeholder="Nama lengkap"
                                value="{{ old('nama_perawat') }}">
                            @error('nama_perawat')
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
                                    {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="P"
                                    {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-5">
                            <label for="pendidikan" class="form-label small">Pendidikan</label>
                            <input type="text" id="pendidikan"
                                class="form-control @error('pendidikan') is-invalid @enderror"
                                name="pendidikan" placeholder="Contoh: D3 Keperawatan, S1 Keperawatan"
                                value="{{ old('pendidikan') }}" maxlength="100">
                            @error('pendidikan')
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
                            <button type="submit" class="btn btn-primary mt-2">Add Perawat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <strong>Data Perawat</strong>
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
                            <th>Pendidikan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perawats ?? collect() as $perawat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $perawat->id_perawat ?? ($perawat->iduser ?? '-') }}</td>
                                <td>{{ $perawat->user->nama ?? '-' }}</td>
                                <td>{{ $perawat->no_hp ?? '-' }}</td>
                                <td>{{ $perawat->alamat ?? '-' }}</td>
                                <td>{{ $perawat->pendidikan ?? '-' }}</td>
                                <td>
                                    <div class="d-grid gap-2 d-md-block">
                                        <a href="{{ route('admin.perawat.show_perawat', $perawat->id_perawat) }}"
                                            class="btn btn-sm btn-info p-1 px-2" title="Lihat"><i
                                                class="bi bi-eye fs-6"></i></a>
                                        <a href="{{ route('admin.perawat.edit_perawat', $perawat->id_perawat) }}"
                                            class="btn btn-sm btn-warning p-1 px-2" title="Edit"><i
                                                class="bi bi-pencil fs-6"></i></a>
                                        <form
                                            action="{{ route('admin.perawat.destroy_perawat', $perawat->id_perawat) }}"
                                            method="POST" class="d-inline"
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
