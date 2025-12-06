@extends('layouts.admin')

@section('title', 'Detail Hewan')
@section('page-heading', 'Detail Hewan')

@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h4 class="mb-1">{{ $pet->nama ?? 'Unnamed Pet' }}</h4>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <small class="text-uppercase text-muted">Jenis Hewan</small>
                                <div>{{ $pet->nama_jenis_hewan ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-uppercase text-muted">Ras</small>
                                <div>{{ $pet->nama_ras ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <small class="text-uppercase text-muted">Jenis Kelamin</small>
                                <div>{{ $pet->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}</div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-uppercase text-muted">Tanggal Lahir</small>
                                <div>
                                    {{ $pet->tanggal_lahir ? \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d-m-Y') : '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <small class="text-uppercase text-muted">Warna/Tanda</small>
                                <div>{{ $pet->warna_tanda ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-uppercase text-muted">Pemilik</small>
                                <div>{{ $pet->pemilik_nama ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('admin.pet.manage_pet') }}"
                                class="btn btn-outline-secondary">← Back</a>
                            <a href="{{ route('admin.pet.edit_pet', $pet->idpet) }}"
                                class="btn btn-primary ms-2">Edit</a>
                            <form action="{{ route('admin.pet.destroy_pet', $pet->idpet) }}"
                                method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus hewan ini?');">
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
@endsection
