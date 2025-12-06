@extends('layouts.admin')

@section('title', 'User Detail')
@section('page-heading', 'User Detail')

@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <!-- LEFT CONTENT -->
            <div class="col-lg-8">

                <!-- Card User Profile -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body d-flex gap-4">
                        <div class="flex-shrink-0 text-center" style="width:120px">
                            <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center mx-auto"
                                style="width:100px;height:100px;font-size:28px;color:#6c757d">
                                {{ strtoupper(substr($user->nama ?? $user->name, 0, 1)) }}
                            </div>
                            <small class="d-block text-muted mt-2">ID: {{ $user->iduser }}</small>
                        </div>

                        <div class="flex-grow-1">
                            <h4 class="mb-1">{{ $user->nama ?? $user->name }}</h4>
                            <p class="mb-2 text-muted"><i class="bi bi-envelope-fill"></i>
                                {{ $user->email }}</p>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <small class="text-uppercase text-muted">Alamat</small>
                                    <div>{{ $pemilik->alamat ?? '-' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-uppercase text-muted">No. WA</small>
                                    <div>{{ $pemilik->no_wa ?? '-' }}</div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <a href="{{ route('admin.manage_user') }}"
                                    class="btn btn-outline-secondary">← Back</a>
                                    <a href="{{ route('admin.user.edit', $user->iduser) }}" class="btn btn-primary ms-2">Edit</a>
                                    <form action="{{ route('admin.user.destroy', $user->iduser) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ms-2">Delete</button>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity -->
                <div class="card mb-4">
                    <div class="card-header">
                        <strong>Activity & Notes</strong>
                    </div>
                    <div class="card-body text-muted">
                        No recent activity.
                    </div>
                </div>

                <!-- Pets -->
                @if (!empty($pets) && $pets->isNotEmpty())
                    <div class="card mb-4">
                        <div class="card-header"><strong>Pets</strong></div>
                        <div class="card-body">
                            <div class="row g-3">

                                @foreach ($pets as $pet)
                                    @php
                                        $petName = $pet->nama ?? 'Unnamed';
                                        $petType = $pet->nama_jenis_hewan ?? ($pet->jenis ?? null);
                                        $petBreed = $pet->nama_ras ?? ($pet->ras ?? null);
                                        $petGender = $pet->jenis_kelamin ?? ($pet->gender ?? null);

                                        $age = '-';

                                        if (!empty($pet->tanggal_lahir)) {
                                            $dob = \Carbon\Carbon::parse($pet->tanggal_lahir);
                                            $now = \Carbon\Carbon::now();

                                            // Jumlah tahun penuh
                                            $years = $dob->diffInYears($now);
                                            // Total bulan kemudian ambil sisa setelah tahun
                                            $months = $dob->diffInMonths($now) % 12;

                                            if ($years < 1) {
                                                // Kurang dari 12 bulan: tampilkan hanya bulan
                                                $age = $months . ' bulan';
                                            } else {
                                                // 1 tahun atau lebih: tampilkan tahun dan, jika ada, bulan
                                                if ($months > 0) {
                                                    $age = $years . ' tahun ' . $months . ' bulan';
                                                } else {
                                                    $age = $years . ' tahun';
                                                }
                                            }
                                        }
                                    @endphp

                                    <div class="col-md-6">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $petName }}</h6>

                                                @if ($petType)
                                                    <p class="mb-1 text-muted small">Jenis:
                                                        {{ $petType }}</p>
                                                @endif

                                                @if ($petBreed)
                                                    <p class="mb-1 text-muted small">Ras:
                                                        {{ $petBreed }}</p>
                                                @endif

                                                @if ($petGender)
                                                    <p class="mb-1">Gender:
                                                        {{ in_array(strtolower($petGender), ['b', 'betina']) ? 'Betina' : (in_array(strtolower($petGender), ['j', 'jantan', 'l']) ? 'Jantan' : ucfirst($petGender)) }}
                                                    </p>
                                                @endif

                                                <div class="text-muted small mb-2">Age:
                                                    {{ $age }}</div>

                                            </div>
                                            <div class="card-footer bg-transparent">
                                                <small class="text-muted">ID Pet:
                                                    {{ $pet->idpet ?? '-' }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <!-- RIGHT SIDEBAR -->
            <div class="col-lg-4">

                <!-- Roles -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header"><strong>Roles</strong></div>
                    <div class="card-body">
                        @if (!empty($roles) && $roles->isNotEmpty())
                            <div class="list-group list-group-flush">
                                @foreach ($roles as $role)
                                    <div class="list-group-item d-flex justify-content-between">
                                        <strong>{{ $role->nama_role }}</strong>
                                        @if (($role->status ?? 0) == 1)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted mb-0">No roles assigned.</p>
                        @endif
                    </div>
                </div>

                <!-- Quick Info -->
                <div class="card shadow-sm">
                    <div class="card-header"><strong>Quick Info</strong></div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Email: <span
                                class="float-end">{{ $user->email }}</span></li>
                        <li class="list-group-item">Role count: <span
                                class="float-end">{{ $roles->count() }}</span></li>
                        <li class="list-group-item">
                            Pets:
                            <span class="float-end">
                                @if (!empty($pets) && $pets->isNotEmpty())
                                    {{ $pets->pluck('nama')->implode(', ') }}
                                @else
                                    -
                                @endif
                            </span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
