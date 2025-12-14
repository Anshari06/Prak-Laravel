@extends('layouts.admin')

@section('title', 'Detail Rekam Medis')
@section('page-heading', 'Detail Rekam Medis')

@section('content')
    <div class="container-fluid p-3">
        <div class="card mb-4 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Detail Rekam Medis</strong>
                <a href="{{ route('pemilik.rekam') }}" class="btn btn-sm btn-outline-secondary">←
                    Kembali</a>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5>Informasi Pet</h5>
                        <p class="mb-1"><strong>Nama:</strong> {{ optional($rekam->pet)->nama ?? '—' }}
                        </p>
                        <p class="mb-1"><strong>Owner:</strong>
                            {{ optional(optional(optional($rekam->pet)->pemilik)->user)->nama ?? '—' }}
                        </p>
                        <p class="mb-1"><strong>Jenis:</strong>
                            {{ optional(optional(optional($rekam->pet)->ras_hewan)->jenisHewan)->nama_jenis_hewan ?? '—' }}
                        </p>
                        <p class="mb-1"><strong>Ras:</strong>
                            {{ optional(optional($rekam->pet)->ras_hewan)->nama_ras ?? '—' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Informasi Rekam</h5>
                        <p class="mb-1"><strong>Tanggal:</strong>
                            {{ $rekam->created_at ? \Carbon\Carbon::parse($rekam->created_at)->format('d/m/Y H:i') : '—' }}
                        </p>
                        <p class="mb-1"><strong>Dokter Pemeriksa:</strong>
                            {{ optional(optional($rekam->dokter)->user)->nama ?? '—' }}</p>
                        <p class="mb-1"><strong>No. Rekam:</strong> {{ $rekam->idrekam_medis ?? '—' }}
                        </p>
                        @if ($rekam->temudokter)
                            <p class="mb-1"><strong>No. Reservasi:</strong>
                                #{{ $rekam->temudokter->idreservasi_dokter }}</p>
                        @endif
                    </div>
                </div>

                <hr>

                <div class="mb-3">
                    <h6>Anamnesa</h6>
                    <p class="mb-0">{{ $rekam->anamnesa ?? '—' }}</p>
                </div>

                <div class="mb-3">
                    <h6>Temuan Klinis</h6>
                    <p class="mb-0">{{ $rekam->temuan_klinis ?? '—' }}</p>
                </div>

                <div class="mb-3">
                    <h6>Diagnosa</h6>
                    <p class="mb-0">{{ $rekam->diagnosa ?? '—' }}</p>
                </div>

                <div class="mb-3">
                    <h6>Tindakan</h6>
                    @if (isset($detail) && $detail->isNotEmpty())
                        <ul class="mb-0">
                            @foreach ($detail as $d)
                                @foreach ($d->katTindakan as $t)
                                    <li>{{ $t->deskripsi_tindakan_terapi ?? '—' }}</li>
                                @endforeach
                            @endforeach
                        </ul>
                    @else
                        <p class="mb-0">Tidak ada tindakan.</p>
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
                            <div class="list-group-item">Tidak ada detail tambahan.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
