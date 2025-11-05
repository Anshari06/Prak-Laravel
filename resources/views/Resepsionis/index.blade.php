@extends('layouts.resepsionis')

@section('title', 'Resepsionis Dashboard')
@section('page-heading', 'Resepsionis Dashboard')

@section('content')
	<div class="row">
		<div class="col-md-8">
			<div class="card mb-3">
				<div class="card-body">
					<h5 class="card-title">Antrian Hari Ini</h5>
					<p class="card-text text-muted">Lihat dan kelola antrian pasien untuk hari ini.</p>
					<a href="/resepsionis/antrian" class="btn btn-sm btn-primary">Kelola Antrian</a>
				</div>
			</div>

			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Registrasi Cepat</h5>
					<p class="card-text text-muted">Tambahkan pendaftaran pasien baru dengan cepat.</p>
					<a href="/resepsionis/registrasi" class="btn btn-sm btn-success">Buka Form Registrasi</a>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card mb-3">
				<div class="card-body">
					<h6 class="mb-0">Hari</h6>
					{{-- <p class="text-muted">{{ \\Carbon\\Carbon::now()->format('l, d F Y') }}</p> --}}
				</div>
			</div>

			<div class="card">
				<div class="card-body">
					<h6 class="mb-0">Statistik Singkat</h6>
					<ul class="list-unstyled small mt-2 mb-0">
						<li>Pasien hari ini: <strong>12</strong></li>
						<li>Antrian menunggu: <strong>3</strong></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
@endsection
