@extends('layouts.pemilik')
@section('title', 'Pemilik Dashboard')
@section('page-heading', 'Dashboard')

@section('content')
    <div class="container-fluid p-0">
        <h2 class="mt-0 mb-2">Welcome {{ session('user_name') }} !</h2>
        <p class="mb-3">Your data is right here</p>
    </div>
    <div class="row">
        <div class="col-6 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <i class='bx bx-paw-print fs-1 me-3 text-primary'></i>
                    <div>
                        <div class="text-muted small">Pet Anda</div>
                        <div class="fs-3 fw-bold">{{ $petCount ?? '—' }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <i class='bi bi-card-checklist fs-1 me-3 text-warning'></i>
                    <div>
                        <div class="text-muted small">Jumlah Reservasi </div>
                        <div class="fs-3 fw-bold">{{ $serveCount ?? '—' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid p-0">
        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h5 class="card-title">Data Pemilik</h5>
                        <p class="mb-1"><strong>Nama:</strong>
                            {{ $pemilik->user->name ?? (session('user_name') ?? '—') }}</p>
                        <p class="mb-1"><strong>Email:</strong>
                            {{ $pemilik->user->email ?? (session('user_email') ?? '—') }}</p>
                        @if (!empty($pemilik->no_wa))
                            <p class="mb-1"><strong>WA:</strong> {{ $pemilik->no_wa }}</p>
                        @endif
                        @if (!empty($pemilik->alamat))
                            <p class="mb-1"><strong>Alamat:</strong> {{ $pemilik->alamat }}</p>
                        @endif
                    </div>
                    <div class="col-md">
                        <h5 class="card-title">Daftar Hewan Peliharaan ({{ $petCount }})</h5>

                        @if ($pets->isEmpty())
                            <div class="alert alert-info">Belum ada data hewan peliharaan.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>Ras</th>
                                            <th>Usia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pets as $pet)
                                            <tr>
                                                <td>{{ $pet->nama ?? '—' }}</td>
                                                <td>{{ $pet->jenis_hewan->nama_jenis_hewan ?? '—' }}
                                                </td>
                                                <td>{{ $pet->ras_hewan->nama_ras ?? '—' }}</td>
                                                <td>{{ $pet->age ?? '—' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
