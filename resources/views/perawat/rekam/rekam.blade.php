@extends('layouts.admin')

@section('title', 'Dokter Dashboard')
@section('page-heading', 'Dashboard')

@section('content')
    <div class="container-fluid p-0">
        <h2 class="mt-0 mb-2"> {{ session('user_name') }}!</h2>
    </div>

    <div class="container-fluid p-3">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Data Rekam Medis</strong>
                <a href="{{ route('perawat.rekam.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Rekam
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:70px">#</th>
                            <th>Tanggal</th>
                            <th>Nama Pet</th>
                            <th>Temuan Klinis</th>
                            <th>Diagnosa</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekam as $i => $rekam)
                            <tr>
                                <td>{{ $rekam->idrekam_medis ?? '-' }}</td>
                                <td>{{ $rekam->created_at ?? '-' }}</td>
                                <td>{{ $rekam->pet->nama ?? '-' }}</td>
                                <td>{{ $rekam->temuan_klinis ?? '-' }}</td>
                                <td>{{ $rekam->diagnosa ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('perawat.rekam.show', $rekam->idrekam_medis) }}"
                                        class="btn btn-sm btn-primary">Lihat Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
