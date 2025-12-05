@extends('layouts.admin')

@section('title', 'Dokter Dashboard')
@section('page-heading', 'Dashboard')

@section('content')
    <div class="container-fluid p-0">
        <h2 class="mt-0 mb-2">Welcome {{ session('user_name') }}!</h2>
        <p class="mb-3">Your data is right here</p>

        <div class="container-fluid mt-3">
            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-journal-medical fs-1 text-primary me-3"></i>
                            <div>
                                <div class="text-muted small">Total Rekam Medis</div>
                                <div class="fs-3 fw-bold">{{ $totalRekamMedis ?? '—' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid p-3">
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Data Rekam Medis</strong>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekamMedis as $i => $rekam)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $rekam->created_at ?? '-' }}</td>
                                    <td>{{ $rekam->pet->nama ?? '-' }}</td>
                                    <td>{{ $rekam->temuan_klinis ?? '-' }}</td>
                                    <td>{{ $rekam->diagnosa ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
