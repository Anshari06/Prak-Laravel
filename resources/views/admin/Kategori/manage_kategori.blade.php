@extends('layouts.admin')

@section('title', 'Manage Kategori')
@section('page-heading', 'Manage Kategori')

@section('content')
    <div class="container-fluid p-0">
        <h2 class="mt-0 mb-2">Manage Kategori</h2>
        <p class="mb-3">Daftar kategori.</p>

        <div class="card mb-4">
            <div class="card-header">
                <strong>Data Kategori</strong>
            </div>
            <div class="table-responsive">
                <table class="table table-striped-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:70px">No</th>
                            <th>ID</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(($kategoris ?? collect()) as $i => $kat)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $kat->id ?? ($kat->idkategori ?? '-') }}</td>
                                <td>{{ $kat->nama_kategori ?? ($kat->name ?? '-') }}</td>
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
                                <td colspan="4" class="text-center py-4">Tidak ada kategori</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
