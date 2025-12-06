@extends('layouts.admin')

@section('title', 'Cetak Nomor Urut Temu Dokter')
@section('page-heading', 'Cetak Nomor Urut Temu Dokter')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 60vh;">
        <div class="card" style="width: 350px; border: 2px solid #333;">
            <div class="card-body text-center p-4">
                <h5 class="card-title mb-3 text-dark">Nomor Urut Anda</h5>

                <div class="mb-4">
                    <div style="font-size: 3rem; font-weight: bold; color: #0066ff;">
                        {{ $nomorUrut }}
                    </div>
                </div>

                <div class="text-start mb-3">
                    <p class="mb-2">
                        <strong>Nama Pet:</strong> {{ $temu->pet->nama ?? '-' }}
                    </p>
                    <p class="mb-2">
                        <strong>Dokter:</strong> {{ $temu->role_user->user->nama ?? '-' }}
                    </p>
                    <p class="mb-2">
                        <strong>Waktu Daftar:</strong>
                        {{ \Carbon\Carbon::parse($temu->waktu_daftar)->format('d-m-Y H:i') }}
                    </p>
                </div>

                <button class="btn btn-primary" onclick="window.print()">
                    <i class="bi bi-printer"></i> Cetak
                </button>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('resepsionis.temu.index') }}" class="link-secondary">Kembali</a>
    </div>
@endsection
