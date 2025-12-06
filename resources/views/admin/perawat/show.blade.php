@extends('layouts.admin')

@section('title', 'Detail Perawat')
@section('page-heading', 'Detail Perawat')

@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body d-flex gap-4">
                        <div class="flex-shrink-0 text-center" style="width:120px">
                            <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center mx-auto"
                                style="width:100px;height:100px;font-size:28px;color:#6c757d">
                                {{ strtoupper(substr($perawat->nama, 0, 1)) }}
                            </div>
                            <small class="d-block text-muted mt-2">ID: {{ $perawat->id_perawat }}</small>
                        </div>

                        <div class="flex-grow-1">
                            <h4 class="mb-1">{{ $perawat->nama }}</h4>
                            <p class="mb-2 text-muted"><i class="bi bi-envelope-fill"></i>
                                {{ $perawat->email }}</p>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <small class="text-uppercase text-muted">Alamat</small>
                                    <div>{{ $perawat->alamat ?? '-' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-uppercase text-muted">No. WA</small>
                                    <div>{{ $perawat->no_hp ?? '-' }}</div>
                                </div>
                            </div>

                            <div class="row g-2 mt-1">
                                <div class="col-md-6">
                                    <small class="text-uppercase text-muted">Pendidikan</small>
                                    <div>{{ $perawat->pendidikan ?? '-' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-uppercase text-muted">Jenis Kelamin</small>
                                    <div>
                                        {{ $perawat->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <a href="{{ route('admin.perawat.manage_perawat') }}"
                                    class="btn btn-outline-secondary">← Back</a>
                                <a href="{{ route('admin.perawat.edit_perawat', $perawat->id_perawat) }}"
                                    class="btn btn-primary ms-2">Edit</a>
                                <form
                                    action="{{ route('admin.perawat.destroy_perawat', $perawat->id_perawat) }}"
                                    method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus perawat ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger ms-2">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
