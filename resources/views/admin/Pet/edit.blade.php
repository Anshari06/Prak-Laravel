@extends('layouts.admin')

@section('title', 'Edit Hewan')
@section('page-heading', 'Edit Hewan')

@section('content')
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <strong>Edit Hewan</strong>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.pet.update_pet', $pet->idpet) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Hewan</label>
                                <input type="text" name="nama" id="nama"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    value="{{ old('nama', $pet->nama) }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="idras_hewan" class="form-label">Ras Hewan</label>
                                <select name="idras_hewan" id="idras_hewan"
                                    class="form-select @error('idras_hewan') is-invalid @enderror"
                                    required>
                                    <option value="">-- Pilih Ras --</option>
                                    @foreach ($rasHewan as $ras)
                                        <option value="{{ $ras->idras_hewan }}"
                                            {{ old('idras_hewan', $pet->idras_hewan) == $ras->idras_hewan ? 'selected' : '' }}>
                                            {{ $ras->nama_ras }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idras_hewan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin"
                                    class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                    required>
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
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    value="{{ old('tanggal_lahir', $pet->tanggal_lahir) }}">
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="warna_tanda" class="form-label">Warna/Tanda Ciri</label>
                                <input type="text" name="warna_tanda" id="warna_tanda"
                                    class="form-control @error('warna_tanda') is-invalid @enderror"
                                    value="{{ old('warna_tanda', $pet->warna_tanda) }}">
                                @error('warna_tanda')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.pet.show_pet', $pet->idpet) }}"
                                class="btn btn-secondary ms-2">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
