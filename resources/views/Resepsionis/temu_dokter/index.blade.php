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
                            <td>{{ $temu->status ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
