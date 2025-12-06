@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-heading', 'Dashboard')

@section('content')
    <h2 class="mt-0 mb-2">Welcome {{ Auth::user()->nama ?? (Auth::user()->name ?? 'User') }}!</h2>
    <p class="mb-3">Your data is right here</p>

    {{-- Statistik cards (akan menampilkan jumlah dari DB) --}}
    <div class="container-fluid mt-3">
        <div class="row g-3">

            <div class="col-6 col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-people fs-1 text-primary me-3"></i>
                        <div>
                            <div class="text-muted small">Total Users</div>
                            <div class="fs-3 fw-bold">{{ $usersCount ?? '—' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <i class='bx bx-paw-print fs-1 me-3 text-primary'></i>
                        <div>
                            <div class="text-muted small">Pet Terdaftar</div>
                            <div class="fs-3 fw-bold">{{ $petCount ?? '—' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-person fs-1 text-primary me-3"></i>
                        <div>
                            <div class="text-muted small">Total Pemilik</div>
                            <div class="fs-3 fw-bold">{{ $pemilikCount ?? '—' }}</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Users table --}}
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header">
                <strong>Users</strong>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width:60px">Number</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $i => $user)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $user->iduser ?? '-' }}</td>
                                    <td>{{ $user->nama ?? '-' }}</td>
                                    <td>{{ $user->email ?? '-' }}</td>

                                    <td class="text-end">
                                        {{-- Example actions: view / edit (implement routes later) --}}
                                        <a href="#"
                                            class="btn btn-sm btn-outline-primary">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">No users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
