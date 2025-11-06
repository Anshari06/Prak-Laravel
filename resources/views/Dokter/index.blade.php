@extends('layouts.dokter')

@section('title', 'Dokter Dashboard')
@section('page-heading', 'Dashboard')

@section('content')
    <div class="container-fluid p-0">
        <h2 class="mt-0 mb-2">Welcome {{ session('user_name') }}!</h2>
        <p class="mb-3">Your data is right here</p>

        <div class="card mb-4">
            <div class="card-header">
                <strong>Data Rekam Medis</strong>
            </div>
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:70px">#</th>
                            <th>ID Rekam Medis</th>
                            <th>Nama Pet</th>
                            <th>Tanggal</th>
                            <th>Temuan Klinis</th>
                            <th>Diagnosa</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekamMedis as $i => $rekam)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $rekam->created_at ?? '-' }}</td>
                                <td>{{ $rekam->pet->nama ?? '-' }}</td>
                                <td>{{ $rekam->nama_pasien ?? '-' }}</td>
                                <td>{{ $rekam->temuan_kklinis ?? '-' }}</td>
                                <td>{{ $rekam->diagnosa ?? '-' }}</td>
                                <td>{{ $rekam->tindakan ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection