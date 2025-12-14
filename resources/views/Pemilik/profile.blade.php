@extends('layouts.pemilik')

@section('title', 'Profil Pemilik')
@section('page-heading', 'Profil Pemilik')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <img src="https://github.com/mdo.png" alt="Profil" class="rounded-circle"
                            width="120" height="120">
                    </div>
                    <h5 class="card-title">{{ $user->nama ?? $user->name }}</h5>
                    <p class="text-muted">Pemilik</p>
                    <p class="small text-muted">{{ $user->email }}</p>
                    <a href="{{ route('pemilik.profile.edit') }}" class="btn btn-primary btn-sm">Edit
                        Profil</a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Profil</h5>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Nama Lengkap</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $user->nama ?? $user->name }}
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $user->email }}
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Role</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <span class="badge bg-primary">Pemilik</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <a href="{{ route('pemilik.profile.edit') }}" class="btn btn-warning">Edit
                                Profil</a>
                            <a href="{{ route('pemilik.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
