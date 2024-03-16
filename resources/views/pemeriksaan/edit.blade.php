@extends('layouts.app')

@section('title', 'Pemeriksaan')

@section('header', 'Edit Pemeriksaan')

@section('content')

<div class="row">
    <div class="page-titles">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item ps-0"><a href="{{ route('pemeriksaan.index') }}">Pemeriksaan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="card shadow-sm">
        <div class="card-header border-0 pb-0">
            <h2 class="card-title">Edit Pemeriksaan</h2>
        </div>
        <form action="{{ route('pemeriksaan.update', $pemeriksaan->id) }}" method="post">
            <div class="card-body pb-0">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nama Pasien
                        <span class="required">*</span>
                    </label>
                    <select name="pasien" class="form-control default-select">
                        <option value="{{ $pemeriksaan->pasien->no_register }}" selected>{{
                            $pemeriksaan->pasien->biodata->nama_lengkap }}</option>
                        <option value="" disabled>-- Pilih Pasien --</option>
                        @foreach ($pasiens as $pasien)
                        <option value="{{ $pasien->no_register }}">{{ $pasien->biodata->nama_lengkap }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Diagnosis
                        <span class="required">*</span>
                    </label>
                    <textarea name="diagnosis" class="form-control" rows="5"
                        placeholder="Diagnosis Penyakit Pasien">{{ old('diagnosis', $pemeriksaan->diagnosis) }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-warning">Ubah</button>
            </div>
        </form>

    </div>

</div>

@endsection