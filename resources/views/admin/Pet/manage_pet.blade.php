@extends('layouts.admin')

@section('title', 'Manage Pet')
@section('page-heading', 'Manage Pet')

@section('content')
    <div class="container-fluid p-0">
        <h2 class="mt-0 mb-2">Manage Pet</h2>
        <p class="mb-3">Daftar hewan peliharaan.</p>

        <div class="card mb-4">
            <div class="card-header">
                <strong>Data Pet</strong>
            </div>
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:70px">No</th>
                            <th>ID</th>
                            <th>Nama Hewan</th>
                            <th>Ras Hewan</th>
                            <th>Jenis</th>
                            <th>Pemilik</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(($pets ?? collect()) as $i => $pet)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $pet->idpet ?? ($pet->id ?? '-') }}</td>
                                <td>{{ $pet->nama ?? ($pet->name ?? '-') }}</td>
                                <td>{{ $pet->ras_hewan->nama_ras ?? ($pet->jenis ?? '-') }}</td>
                                <td>{{ $pet->ras_hewan->jenisHewan->nama_jenis_hewan ?? ($pet->jenis ?? '-') }}
                                </td>
                                <td>{{ $pet->pemilik->user->nama ?? ($pet->pemilik->nama ?? '-') }}</td>
                                <td>
                                    <div class="d-grid gap-2 d-md-block">
                                        <a href="{{ route('admin.pet.show_pet', $pet->idpet) }}"
                                            class="btn btn-sm btn-info p-1 px-2" title="Lihat"><i
                                                class="bi bi-eye fs-6"></i></a>
                                        <a href="{{ route('admin.pet.edit_pet', $pet->idpet) }}"
                                            class="btn btn-sm btn-warning p-1 px-2" title="Edit"><i
                                                class="bi bi-pencil fs-6"></i></a>
                                        <form action="{{ route('admin.pet.destroy_pet', $pet->idpet) }}"
                                            method="POST" class="d-inline"
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
                                <td colspan="7" class="text-center py-4">Tidak ada data hewan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
