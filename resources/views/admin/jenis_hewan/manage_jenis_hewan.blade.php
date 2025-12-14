@extends('layouts.admin')

@section('title', 'Manage Jenis Hewan')
@section('page-heading', 'Manage Jenis Hewan')

@section('content')
    <div class="container-fluid p-0">
        <h2 class="mt-0 mb-2">Welcome</h2>
        <p class="mb-3">Your data is right here</p>

        {{-- add form --}}
        <div class="card mb-3">
            <div class="card-header">
                <strong>Add New Jenis Hewan</strong>
            </div>
            <div class="card-body">
                <div class="card-shadow">
                    <form action="{{ route('admin.add_jenis_hewan') }}" method="POST" class="row g-3 p-3">
                        @csrf

                        @if ($errors->any())
                            <div class="col-12">
                                <div class="alert alert-danger p-2">
                                    <ul class="mb-0 small">
                                        @foreach ($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-6">
                            <input type="text"
                                class="form-control @error('nama_jenis') is-invalid @enderror"
                                name="nama_jenis" placeholder="Nama Jenis Hewan"
                                value="{{ old('nama_jenis') }}">
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary w-100">Add Jenis
                                Hewan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        {{-- Table: Daftar Jenis Hewan --}}
        <div class="card">
            <div class="card-header">
                <strong>Daftar Jenis Hewan</strong>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width:60px">Num</th>
                                <th scope="row">ID</th>
                                <th scope="row">Nama Jenis Hewan</th>
                                <th scope="row" style="width:280px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jenisHewans ?? collect() as $i => $jenis)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $jenis->idjenis_hewan ?? '-' }}</td>
                                    <td>{{ $jenis->nama_jenis_hewan ?? '-' }}</td>
                                    <td>
                                        <form method="POST"
                                            action="{{ route('admin.update_jenis_hewan', $jenis->idjenis_hewan) }}"
                                            class="row g-2 align-items-center mb-2">
                                            @csrf
                                            @method('PUT')
                                            <div class="col">
                                                <input type="text" name="nama_jenis"
                                                    class="form-control form-control-sm"
                                                    value="{{ $jenis->nama_jenis_hewan ?? '' }}"
                                                    placeholder="Nama Jenis Hewan">
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-save"></i>
                                                </button>
                                            </div>
                                        </form>
                                        <form method="POST"
                                            action="{{ route('admin.delete_jenis_hewan', $jenis->idjenis_hewan) }}"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">No jenis hewan found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
