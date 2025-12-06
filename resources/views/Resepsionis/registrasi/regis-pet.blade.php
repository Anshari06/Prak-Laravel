@extends('layouts.admin')

@section('title', 'Resepsionis Dashboard')
@section('page-heading', 'Resepsionis Dashboard')

@section('content')

    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Form Registrasi Hewan Peliharaan</h4>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('resepsionis.regis-pet.store') }}" method="POST" class="row g-3 mb-4">
                @csrf
                <div class="col-md-4">
                    <label class="form-label">Nama Hewan</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}"
                        required>
                    @error('nama')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control"
                        value="{{ old('tanggal_lahir') }}">
                    @error('tanggal_lahir')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label">Warna / Tanda</label>
                    <input type="text" name="warna_tanda" class="form-control"
                        value="{{ old('warna_tanda') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select">
                        <option value="">-- Pilih --</option>
                        <option value="J" {{ old('jenis_kelamin') == 'J' ? 'selected' : '' }}>
                            Jantan
                        </option>
                        <option value="B" {{ old('jenis_kelamin') == 'B' ? 'selected' : '' }}>
                            Betina
                        </option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Pemilik</label>
                    <select name="idpemilik" class="form-select" required>
                        <option value="">-- Pilih Pemilik --</option>
                        @if (isset($pemiliks))
                            @foreach ($pemiliks as $p)
                                <option value="{{ $p->idpemilik }}"
                                    {{ old('idpemilik') == $p->idpemilik ? 'selected' : '' }}>
                                    {{ optional($p->user)->nama ?? 'Pemilik#' . $p->idpemilik }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('idpemilik')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Ras Hewan</label>
                    <select name="idras_hewan" class="form-select" required>
                        <option value="">-- Pilih Ras --</option>
                        @if (isset($ras))
                            @foreach ($ras as $r)
                                <option value="{{ $r->idras_hewan }}"
                                    {{ old('idras_hewan') == $r->idras_hewan ? 'selected' : '' }}>
                                    {{ $r->nama_ras }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('idras_hewan')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <button class="btn btn-success">Simpan</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:70px">No</th>
                            <th>Nama Hewan</th>
                            <th>Ras Hewan</th>
                            <th>Jenis Hewan</th>
                            <th>Jenis Kelamin</th>
                            <th>Nama Pemilik</th>
                            <th style="width:100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pets as $i => $pet)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $pet->nama }}</td>
                                <td>{{ optional($pet->ras_hewan)->nama_ras ?? '-' }}</td>
                                <td>{{ optional(optional($pet->ras_hewan)->jenisHewan)->nama_jenis_hewan ?? '-' }}
                                </td>
                                <td>{{ $pet->jenis_kelamin == 'J' ? 'Jantan' : ($pet->jenis_kelamin == 'B' ? 'Betina' : '-') }}
                                </td>
                                <td>{{ optional(optional($pet->pemilik)->user)->nama ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('resepsionis.regis-pet.edit', $pet->idpet) }}"
                                        class="btn btn-sm btn-warning p-1 px-2" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" class="d-inline"
                                        action="{{ route('resepsionis.regis-pet.delete', $pet->idpet) }}"
                                        onsubmit="return confirm('Yakin ingin menghapus pet ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger p-1 px-2"
                                            title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
