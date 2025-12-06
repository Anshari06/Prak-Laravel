@extends('layouts.admin')

@section('title', 'Temu Dokter')
@section('page-heading', 'Daftar Temu Dokter')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Daftar Temu Dokter</strong>
            <a href="{{ route('resepsionis.temu.create') }}" class="btn btn-primary btn-sm">+ Tambah Temu Dokter</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:70px">#</th>
                        <th>ID Reservasi</th>
                        <th>Tanggal</th>
                        <th>No. Urut (per hari)</th>
                        <th>Pet</th>
                        <th>Dokter</th>
                        <th>Status</th>
                        <th style="width:100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($temus as $i => $temu)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $temu->idreservasi_dokter }}</td>
                            <td>{{ \Carbon\Carbon::parse($temu->waktu_daftar) ?? '-' }}
                            </td>
                            <td>{{ $temu->computed_no_urut ?? ($temu->no_urut ?? '-') }}</td>
                            <td>{{ $temu->pet->nama ?? '-' }}</td>
                            <td>{{ $temu->role_user->user->nama ?? '-' }}</td>
                            <td>
                                @if ($temu->status === 'P')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif ($temu->status === 'S')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif ($temu->status === 'C')
                                    <span class="badge bg-danger">Batal</span>
                                @else
                                    <span class="badge bg-secondary">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('resepsionis.temu.edit', $temu->idreservasi_dokter) }}" class="btn btn-sm btn-warning p-1 px-2" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" class="d-inline" action="{{ route('resepsionis.temu.delete', $temu->idreservasi_dokter) }}" onsubmit="return confirm('Yakin ingin menghapus temu dokter ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger p-1 px-2" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
