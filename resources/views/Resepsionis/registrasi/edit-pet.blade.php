@extends('layouts.admin')

@section('title', 'Edit Hewan Peliharaan')
@section('page-heading', 'Edit Hewan Peliharaan')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Form Edit Hewan Peliharaan</h5>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('resepsionis.regis-pet.update', $pet->idpet) }}" method="POST"
                class="row g-3">
                @csrf
                @method('PUT')

                <div class="col-md-4">
                    <label class="form-label">Nama Hewan</label>
                    <input type="text" name="nama"
                        class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama', $pet->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir"
                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                        value="{{ old('tanggal_lahir', $pet->tanggal_lahir) }}">
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label class="form-label">Warna / Tanda</label>
                    <input type="text" name="warna_tanda"
                        class="form-control @error('warna_tanda') is-invalid @enderror"
                        value="{{ old('warna_tanda', $pet->warna_tanda) }}">
                    @error('warna_tanda')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin"
                        class="form-select @error('jenis_kelamin') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        <option value="J"
                            {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'J' ? 'selected' : '' }}>
                            Jantan</option>
                        <option value="B"
                            {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'B' ? 'selected' : '' }}>
                            Betina</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Pemilik</label>
                    <select name="idpemilik"
                        class="form-select @error('idpemilik') is-invalid @enderror" required>
                        <option value="">-- Pilih Pemilik --</option>
                        @foreach ($pemiliks as $p)
                            <option value="{{ $p->idpemilik }}"
                                {{ old('idpemilik', $pet->idpemilik) == $p->idpemilik ? 'selected' : '' }}>
                                {{ optional($p->user)->nama ?? 'Pemilik#' . $p->idpemilik }}
                            </option>
                        @endforeach
                    </select>
                    @error('idpemilik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Ras Hewan</label>
                    <select name="idras_hewan"
                        class="form-select @error('idras_hewan') is-invalid @enderror" required>
                        <option value="">-- Pilih Ras --</option>
                        @foreach ($ras as $r)
                            <option value="{{ $r->idras_hewan }}"
                                {{ old('idras_hewan', $pet->idras_hewan) == $r->idras_hewan ? 'selected' : '' }}>
                                {{ $r->nama_ras }}
                            </option>
                        @endforeach
                    </select>
                    @error('idras_hewan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('resepsionis.regis-pet') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
