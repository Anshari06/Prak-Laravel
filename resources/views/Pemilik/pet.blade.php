@extends('layouts.admin')

@section('title', 'Data Pet')
@section('page-heading', 'Data Pet Saya')

@section('content')
    <div class="container-fluid p-0">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Daftar Pet</strong>
                <a href="{{ route('pemilik.index') }}" class="btn btn-sm btn-outline-secondary">←
                    Dashboard</a>
            </div>
            <div class="card-body">
                @if ($pets->isEmpty())
                    <div class="alert alert-info mb-0">Belum ada data hewan.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:80px">ID</th>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Ras</th>
                                    <th>Warna/Tanda</th>
                                    <th>Gender</th>
                                    <th>Tgl Lahir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pets as $pet)
                                    <tr>
                                        <td>{{ $pet->idpet }}</td>
                                        <td>{{ $pet->nama ?? '—' }}</td>
                                        <td>{{ $pet->ras_hewan->jenisHewan->nama_jenis_hewan ?? '—' }}
                                        </td>
                                        <td>{{ $pet->ras_hewan->nama_ras ?? '—' }}</td>
                                        <td>{{ $pet->warna_tanda ?? '—' }}</td>
                                        <td>
                                            @php $g = strtolower($pet->jenis_kelamin ?? ''); @endphp
                                            {{ $g === 'j' ? 'Jantan' : ($g === 'b' ? 'Betina' : $pet->jenis_kelamin ?? '—') }}
                                        </td>
                                        <td>{{ $pet->tanggal_lahir ? \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d/m/Y') : '—' }}
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
