@extends('layouts.admin')

@section('title', 'Manage Klinis')
@section('page-heading', 'Manage Klinis')

@section('content')
    <div class="container-fluid p-0">
        <h2 class="mt-0 mb-2">Manage Klinis</h2>
        <p class="mb-3">Daftar klinis / catatan medis.</p>

        <div class="card mb-4">
            <div class="card-header">
                <strong>Data Klinis</strong>
            </div>
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:70px">No</th>
                            <th>ID</th>
                            <th>Nama Kategori Klinis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(($kliniss ?? collect()) as $i => $k)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $k->idkategori_klinis }}</td>
                                <td>{{ $k->nama_kategori_klinis }}</td>
                                <td>
                                    <div class="d-grid gap-2 d-md-block">
                                        <a href="#" class="btn btn-sm btn-info p-1 px-2"
                                            title="Lihat"><i class="bi bi-eye fs-6"></i></a>
                                        <a href="#" class="btn btn-sm btn-warning p-1 px-2"
                                            title="Edit"><i class="bi bi-pencil fs-6"></i></a>
                                        <form method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-danger p-1 px-2" title="Hapus"><i
                                                    class="bi bi-trash fs-6"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">Tidak ada catatan klinis
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
