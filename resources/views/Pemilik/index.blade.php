@extends('layouts.admin')
@section('title', 'Pemilik Dashboard')
@section('page-heading', 'Dashboard')

@section('content')
    <div class="container-fluid p-0">
        <h2 class="mt-0 mb-2">Welcome {{ session('user_name') }} !</h2>
        <p class="mb-3">Your data is right here</p>
    </div>
    <div class="row g-3 g-md-4">
        <div class="col-6 col-md-4 col-xl-3">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <i class='bx bx-paw-print fs-1 me-3 text-primary'></i>
                    <div>
                        <div class="text-muted small">Pet Anda</div>
                        <div class="fs-3 fw-bold mb-0">{{ $petCount ?? '—' }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-3">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <i class='bi bi-calendar2-check fs-1 me-3 text-success'></i>
                    <div>
                        <div class="text-muted small">Jumlah Reservasi</div>
                        <div class="fs-3 fw-bold mb-0">{{ $serveCount ?? '—' }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-3">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <i class='bi bi-journal-medical fs-1 me-3 text-warning'></i>
                    <div>
                        <div class="text-muted small">Jumlah Rekam Medis</div>
                        <div class="fs-3 fw-bold mb-0">{{ $rekamcount ?? '—' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid p-0">
        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
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
                                                <td>{{ !empty($pet->tanggal_lahir) ? \Carbon\Carbon::parse($pet->tanggal_lahir)->age . ' tahun' : '—' }}
                                                </td>
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
