@extends('layouts.admin')

@section('title', 'Edit User')
@section('page-heading', 'Edit User')

@section('content')
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <strong>Edit User</strong>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.user.update', $user->iduser) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    value="{{ old('nama', $user->nama ?? $user->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control"
                                    value="{{ old('alamat', $pemilik->alamat ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label for="no_wa" class="form-label">No. WA</label>
                                <input type="text" name="no_wa" id="no_wa" class="form-control"
                                    value="{{ old('no_wa', $pemilik->no_wa ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Roles</label>
                                <div class="card">
                                    <div class="card-body">
                                        @foreach ($allRoles as $role)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    name="roles[]" value="{{ $role->idrole }}"
                                                    id="role_{{ $role->idrole }}"
                                                    {{ in_array($role->idrole, old('roles', $userRoles)) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="role_{{ $role->idrole }}">
                                                    {{ $role->nama_role }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.user.show', $user->iduser) }}"
                                class="btn btn-secondary ms-2">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
