@extends('layouts.admin')

@section('title', 'Manage Users')
@section('page-heading', 'Manage Users')

@section('content')
    <div class="container-fluid p-0">
        <h2 class="mt-0 mb-2">Welcome</h2>
        <p class="mb-3">Your data is right here</p>

        <div class="card mb-4">
            <div class="card-header">
                <strong>Data Users</strong>
            </div>
            <div class="table-responsive">
                <table class="table table-striped-hover mb-0">
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
                                <td>{{ $user->nama_role ?? 'belum tersambung' }}</td>
                                <td>
                                    <div class="d-grid gap-2 d-md-block">
                                        <a class="btn btn-sm btn-info p-1 px-2" title="Lihat"><i
                                                class="bi bi-eye fs-6"></i></a>
                                        <a class="btn btn-sm btn-warning p-1 px-2" title="Edit"><i
                                                class="bi bi-pencil fs-6"></i></a>
                                        <form method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus?')">
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
@endsection
