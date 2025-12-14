@extends('layouts.admin')

@section('title', 'Data Reservasi')
@section('page-heading', 'Data Reservasi Pet')

@section('content')
    <div class="container-fluid p-0">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Daftar Reservasi</strong>
                <a href="{{ route('pemilik.index') }}" class="btn btn-sm btn-outline-secondary">←
                    Dashboard</a>
            </div>
            <div class="card-body">
                @if ($reservasis->isEmpty())
                    <div class="alert alert-info mb-0">Belum ada data reservasi.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:90px">ID</th>
                                    <th>Pet</th>
                                    <th>Dokter</th>
                                    <th>No. Urut</th>
                                    <th>Status</th>
                                    <th>Waktu Daftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservasis as $r)
                                    <tr>
                                        <td>#{{ $r->idreservasi_dokter }}</td>
                                        <td>{{ optional($r->pet)->nama ?? '—' }}</td>
                                        <td>{{ optional(optional($r->role_user)->user)->nama ?? '—' }}
                                        </td>
                                        <td>{{ $r->no_urut ?? '—' }}</td>
                                        <td>{{ $r->status ?? '—' }}</td>
                                        <td>{{ $r->waktu_daftar ? \Carbon\Carbon::parse($r->waktu_daftar)->format('d/m/Y H:i') : '—' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
