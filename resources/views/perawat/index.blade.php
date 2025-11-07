@extends('layouts.perawat')
@section('title', 'Perawat Dashboard')
@section('page-heading', 'Dashboard')

@section('content')
    <div class="container-fluid p-0">
        <h2 class="mt-0 mb-2">Welcome {{ session('user_name') }}!</h2>
        <p class="mb-3">Your data is right here</p>
    </div>

    <div class="container-fluid p-0">
        <div class="card mt-4">
            <div class="card-body">

                <div class="col-md-3">
                    <h5 class="card-title">Data Rekam Medis</h5>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>created_at</th>
                                <th>anamnesa</th>
                                <th>temuan_klinis</th>
                                <th>diagnosa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rekam as $i => $rec)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $rec->created_at ?? '-' }}</td>
                                    <td>{{ $rec->anamnesa ?? '-' }}</td>
                                    <td>{{ $rec->temuan_klinis ?? '-' }}</td>
                                    <td>{{ $rec->diagnosa ?? '-' }}</td>
                                    <td>
                                        <a href="detail-rekam" class="btn btn-sm btn-primary">Lihat</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data rekam
                                        medis.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
@endsection
