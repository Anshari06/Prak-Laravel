@extends('layouts.admin')

@section('title', 'Manage Tindakan')
@section('page-heading', 'Manage Tindakan')

@section('content')
    <div class="container-fluid p-0">
        <h2 class="mt-0 mb-2">Manage Tindakan</h2>
        <p class="mb-3">Daftar tindakan klinis.</p>

        <div class="card mb-4">
            <div class="card-header">
                <strong>Data Tindakan</strong>
            </div>
            <div class="table-responsive">
                <table class="table table-striped-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:70px">No</th>
                            <th>ID</th>
                            <th>Nama Tindakan</th>
                            <th>Kategori</th>
                            <th>Klinis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(($tindakans ?? collect()) as $i => $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $item->idkode_tindakan_terapi ?? '-' }}</td>
                                <td>{{ $item->deskripsi_tindakan_terapi ?? '-' }}</td>
                                <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                <td>{{ $item->kat_klinis->nama_kategori_klinis ?? '-' }}</td>
                                <td>
                                    <div class="d-grid gap-2 d-md-block">
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
                                <td colspan="6" class="text-center py-4">Tidak ada data tindakan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
