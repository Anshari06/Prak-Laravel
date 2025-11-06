@extends('layouts.resepsionis')

@section('title', 'Resepsionis Dashboard')
@section('page-heading', 'Resepsionis Dashboard')

@section('content')

    <div class="card-head">
        <h4 class="card-title">Form Registrasi Hewan Peliharaan</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:70px">No</th>
                        <th>Nama Hewan</th>
                        <th>Jenis Hewan</th>
                        <th>Umur</th>
                        <th>Nama Pemilik</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pets as $i => $pet)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $pet->nama_hewan }}</td>
                            <td>{{ $pet->jenis_hewan }}</td>
                            <td>{{ $pet->umur }}</td>
                            <td>{{ $pet->nama_pemilik }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection