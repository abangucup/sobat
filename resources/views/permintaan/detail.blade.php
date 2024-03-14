@extends('layouts.app')

@section('title', 'Detail Permintaan')

@section('header', 'Detail Permintaan')

@section('content')

<div class="row">
    <div class="page-titles">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item ps-0"><a href="{{ route('permintaan.setuju') }}">Permintaan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>
    </div>

    <div class="card  shadow-sm">
        <div class="card-body pb-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex px-0 justify-content-between">
                    <strong>BIDANG PENGAJU</strong>
                    <span class="mb-0">{{ Str::upper($permintaan->bidang) }}</span>
                </li>
                <li class="list-group-item d-flex px-0 justify-content-between">
                    <strong>NAMA PENGAJU</strong>
                    <span class="mb-0">{{ $permintaan->userPengaju->biodata->nama_lengkap }}</span>
                </li>
                <li class="list-group-item d-flex px-0 justify-content-between">
                    <strong>NAMA REAGEN/BHP/OBAT</strong>
                    <span class="mb-0">{{ $permintaan->stokObat->obat->nama_obat }}</span>
                </li>
                <li class="list-group-item d-flex px-0 justify-content-between">
                    <strong>NO. BATCH</strong>
                    <span class="mb-0">{{ $permintaan->stokObat->obat->no_batch }}</span>
                </li>
                <li class="list-group-item d-flex px-0 justify-content-between">
                    <strong>TANGGAL KEDALUWARSA</strong>
                    <span class="mb-0">{{
                        Carbon\Carbon::parse($permintaan->stokObat->obat->tanggal_kedaluwarsa)->isoFormat('LL')
                        }}</span>
                </li>
                <li class="list-group-item d-flex px-0 justify-content-between">
                    <strong>BANYAK PERMINTAAN</strong>
                    <span class="mb-0">{{ $permintaan->banyak }}</span>
                </li>
                <li class="list-group-item d-flex px-0 justify-content-between">
                    <strong>STATUS PERMINTAAN</strong>
                    <span class="mb-0">{{ Str::upper($permintaan->status_permintaan) }}</span>
                </li>
                <li class="list-group-item d-flex px-0 justify-content-between">
                    <strong>TANGGAL PENGAJUAN</strong>
                    <span class="mb-0">{{ Carbon\Carbon::parse($permintaan->created_at)->isoFormat('LL') }}</span>
                </li>
                <li class="list-group-item d-flex px-0 justify-content-between">
                    <strong>CATATAN</strong>
                    <span class="mb-0">{{ $permintaan->catatan ?? '-' }}</span>
                </li>
            </ul>
        </div>
    </div>

</div>

@endsection