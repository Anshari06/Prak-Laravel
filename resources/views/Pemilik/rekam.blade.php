@extends('layouts.admin')

@section('title', 'Rekam Medis')
@section('page-heading', 'Rekam Medis Pet')

@section('content')
    <div class="container-fluid p-0">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Daftar Rekam Medis</strong>
                <a href="{{ route('pemilik.index') }}" class="btn btn-sm btn-outline-secondary">←
                    Dashboard</a>
            </div>
            <div class="card-body">
                @if ($rekams->isEmpty())
                    <div class="alert alert-info mb-0">Belum ada rekam medis untuk pet Anda.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:80px">ID</th>
                                    <th style="width:130px">Tanggal</th>
                                    <th>Pet</th>
                                    <th>Dokter Pemeriksa</th>
                                    <th>Anamnesa</th>
                                    <th>Temuan Klinis</th>
                                    <th>Diagnosa</th>
                                    <th style="width:110px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rekams as $rekam)
                                    <tr>
                                        <td>#{{ $rekam->idrekam_medis }}</td>
                                        <td>{{ $rekam->created_at ? \Carbon\Carbon::parse($rekam->created_at)->format('d/m/Y H:i') : '—' }}
                                        </td>
                                        <td>
                                            {{ optional($rekam->pet)->nama ?? '—' }}
                                            @if (optional(optional($rekam->pet)->ras_hewan)->jenisHewan)
                                                <div class="text-muted small">
                                                    {{ $rekam->pet->ras_hewan->jenisHewan->nama_jenis_hewan ?? '' }}
                                                    ·
                                                    {{ $rekam->pet->ras_hewan->nama_ras ?? '' }}
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ optional(optional($rekam->dokter)->user)->nama ?? '—' }}
                                        </td>
                                        <td>{{ $rekam->anamnesa ? \Illuminate\Support\Str::limit($rekam->anamnesa, 50) : '—' }}
                                        </td>
                                        <td>{{ $rekam->temuan_klinis ? \Illuminate\Support\Str::limit($rekam->temuan_klinis, 50) : '—' }}
                                        </td>
                                        <td>{{ $rekam->diagnosa ? \Illuminate\Support\Str::limit($rekam->diagnosa, 50) : '—' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('pemilik.rekam.show', $rekam->idrekam_medis) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                Detail
                                            </a>
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
