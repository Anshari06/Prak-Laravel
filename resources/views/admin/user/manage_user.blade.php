@extends('layouts.admin')

@section('title', 'Manage Users')
@section('page-heading', 'Manage Users')

@section('content')
    <div class="container-fluid p-0">
        <h2 class="mt-0 mb-2">Welcome</h2>
        <p class="mb-3">Your data is right here</p>

        {{-- form add --}}
        <div class="card mb-4 ">
            <div class="card-header">
                <strong>Add New User</strong>
            </div>
            <div class="card-body">
                <div class="card-shadow">
                    <form action="{{ route('admin.add_user') }}" method="POST" class="row g-3 p-3">
                        @csrf

                        @if ($errors->any())
                            <div class="col-12">
                                <div class="alert alert-danger p-2">
                                    <ul class="mb-0 small">
                                        @foreach ($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-4">
                            <input type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="Name" value="{{ old('name') }}" required>
                        </div>

                        <div class="col-md-4">
                            <input type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                placeholder="Email" value="{{ old('email') }}" required>
                        </div>

                        <div class="col-md-4">
                            <input type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password" placeholder="Password" required>
                        </div>

                        <div class="col-md-4">
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Confirm Password" required>
                        </div>

                        <div class="col-md-4">
                            <select class="form-select @error('idrole') is-invalid @enderror"
                                name="idrole" required>
                                <option value="" disabled selected>Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->idrole }}"
                                        {{ old('idrole') == $role->idrole ? 'selected' : '' }}>
                                        {{ $role->nama_role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <strong>Data Users</strong>
            </div>

            {{-- table --}}
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:70px">No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $i => $user)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $user->nama ?? $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @forelse ($user->roleUser as $relasi)
                                        {{ $relasi->role->nama_role }}
                                        @if (!$loop->last)
                                            ,
                                        @endif @empty
                                        -
                                    @endforelse
                                </td>
                                <td>
                                    <div class="d-grid gap-2 d-md-block">
                                        <a href="{{ route('admin.user.show', $user->iduser) }}"
                                            class="btn btn-sm btn-info p-1 px-2" title="Lihat"><i
                                                class="bi bi-eye fs-6"></i></a>
                                        <a href="{{ route('admin.user.edit', $user->iduser) }}"
                                            class="btn btn-sm btn-warning p-1 px-2" title="Edit"><i
                                                class="bi bi-pencil fs-6"></i></a>
                                        <form action="{{ route('admin.user.destroy', $user->iduser) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-danger p-1 px-2" title="Hapus"><i
                                                    class="bi bi-trash fs-6"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection
