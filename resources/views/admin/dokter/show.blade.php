@extends('layouts.admin')

@section('title', 'Detail Dokter')
@section('page-heading', 'Detail Dokter')

@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body d-flex gap-4">
                        <div class="flex-shrink-0 text-center" style="width:120px">
                            <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center mx-auto"
                                style="width:100px;height:100px;font-size:28px;color:#6c757d">
                                {{ strtoupper(substr($dokter->nama, 0, 1)) }}
                            </div>
                            <small class="d-block text-muted mt-2">ID: {{ $dokter->id_dokter }}</small>
                        </div>

                        <div class="flex-grow-1">
                            <h4 class="mb-1">{{ $dokter->nama }}</h4>
                            <p class="mb-2 text-muted"><i class="bi bi-envelope-fill"></i>
                                {{ $dokter->email }}</p>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <small class="text-uppercase text-muted">Alamat</small>
                                    <div>{{ $dokter->alamat ?? '-' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-uppercase text-muted">No. HP</small>
                                    <div>{{ $dokter->no_hp ?? '-' }}</div>
                                </div>
                            </div>

                            <div class="row g-2 mt-1">
                                <div class="col-md-6">
                                    <small class="text-uppercase text-muted">Bidang Dokter</small>
                                    <div>{{ $dokter->bidang_dokter ?? '-' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-uppercase text-muted">Jenis Kelamin</small>
                                    <div>{{ $dokter->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <a href="{{ route('admin.dokter.manage_dokter') }}"
                                    class="btn btn-outline-secondary">← Back</a>
                                <a href="{{ route('admin.dokter.edit_dokter', $dokter->id_dokter) }}"
                                    class="btn btn-primary ms-2">Edit</a>
                                <form
                                    action="{{ route('admin.dokter.delete_dokter', $dokter->id_dokter) }}"
                                    method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus dokter ini?');">
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
