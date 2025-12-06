@extends('layouts.admin')

@section('title', 'Resepsionis Dashboard')
@section('page-heading', 'Dashboard')

@section('content')
    <div class="row">
		
		<div class="col-md-5">
			<div class="card mb-3">
				<div class="card-body">
					<h5 class="card-title">Antrian Hari Ini</h5>
                    <p class="card-text text-muted">Lihat dan kelola antrian pasien untuk hari ini.</p>
                    <a href="{{route ('resepsionis.temu.create')}}" class="btn btn-sm btn-primary">Kelola Antrian</a>
                </div>
            </div>
			
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Registrasi Cepat</h5>
                    <p class="card-text text-muted">Tambahkan pendaftaran pasien (Pet) baru dengan cepat.</p>
                    <a href="{{ route('resepsionis.regis-pet') }}" class="btn btn-sm btn-success">Buka
                        Form Registrasi</a>
                </div>
            </div>
        </div>

		<div class="col-6 col-md-3 mb-3 d-grid gap-3">
			<div class="card shadow-sm">
				<div class="card-body d-flex align-items-center">
					<i class="bi bi-person-lines-fill fs-1 text-primary me-3"></i>
					<div>
						<div class="text-muted small">Total Temu</div>
						<div class="fs-3 fw-bold">{{ $TemuCount ?? '—' }}</div>
					</div>
				</div>
			</div>
			<div class="card shadow-sm">
				<div class="card-body d-flex align-items-center">
					<i class="bi bi-person fs-1 text-primary me-3"></i>
					<div>
						<div class="text-muted small">Total Pemilik</div>
						<div class="fs-3 fw-bold">{{ $PemilikCount ?? '—' }}</div>
					</div>
				</div>
			</div>
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-card-list fs-1 text-primary me-3"></i>
                    <div>
                        <div class="text-muted small">Total Pet</div>
                        <div class="fs-3 fw-bold">{{ $PetCount ?? '—' }}</div>
                    </div>
                </div>
            </div>
		</div>

        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="mb-0">Hari</h6>
                    <p class="text-muted">{{ \Carbon\Carbon::now()->format('l, d F Y') }}</p>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h6 class="mb-0">Statistik Singkat</h6>
                    <ul class="list-unstyled small mt-2 mb-0">
                        <li>Antrian menunggu: <strong>{{$temuStatus}} </strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
