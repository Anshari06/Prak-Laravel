@extends('layouts.admin')

@section('title', 'Detail Rekam Medis')
@section('page-heading', 'Detail Rekam Medis')

@section('content')
    <div class="container-fluid p-3">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Detail Rekam Medis</strong>
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5>Informasi Pet</h5>
                        <p class="mb-1"><strong>Nama:</strong> {{ optional($rekam->pet)->nama ?? '-' }}
                        </p>
                        <p class="mb-1"><strong>Owner:</strong>
                            {{ optional(optional(optional($rekam->pet)->pemilik)->user)->nama ?? '-' }}
                        </p>
                        <p class="mb-1"><strong>Jenis:</strong>
                            {{ optional(optional(optional($rekam->pet)->ras_hewan)->jenisHewan)->nama_jenis_hewan ?? '-' }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h5>Informasi Rekam</h5>
                        <p class="mb-1"><strong>Tanggal:</strong> {{ $rekam->created_at ?? '-' }}</p>
                        <p class="mb-1"><strong>Dokter Pemeriksa:</strong>
                            {{ optional(optional($rekam->dokter)->user)->nama ?? '-' }}</p>
                        <p class="mb-1"><strong>No. Rekam:</strong> {{ $rekam->idrekam_medis ?? '-' }}
                        </p>
                    </div>
                </div>

                <hr>

                <div class="mb-3">
                    <h6>Temuan Klinis</h6>
                    <p>{{ $rekam->temuan_klinis ?? '-' }}</p>
                </div>

                <div class="mb-3">
                    <h6>Diagnosa</h6>
                    <p>{{ $rekam->diagnosa ?? '-' }}</p>
                </div>

                <div class="mb-3">
                    <h6>Tindakan</h6>
                    @if (isset($detail) && $detail->isNotEmpty())
                        <ul>
                            @foreach ($detail as $tindakan)
                                @foreach ($tindakan->katTindakan as $tindakan)
                                    <li>{{ $tindakan->deskripsi_tindakan_terapi ?? '-' }}</li>
                                @endforeach
                            @endforeach
                        </ul>
                    @else
                        <p>Tidak ada tindakan.</p>
                    @endif
                </div>

                <div>
                    <h6>Detail Tambahan</h6>
                    <div class="list-group">
                        @if (isset($detail) && $detail->isNotEmpty())
                            @foreach ($detail as $d)
                                <div class="list-group-item">
                                    {{ $d->detail ?? json_encode($d) }}
                                </div>
                            @endforeach
                        @else
                            <div class="list-group-item">
                                Tidak ada detail tambahan.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
