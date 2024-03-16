@extends('layouts.app')

@section('title', 'Laporann Pemeriksaan')

@section('header', 'Laporan Rekam Medis')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Laporan Rekam Medis</h3>
        <a href="{{ route('cetak.laporanPemeriksaan') }}" target="_blank" class="btn btn-sm btn-danger text-end"><i
                class="fa-solid fa-print me-2"></i>Cetak Laporan</a>
    </div>

    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="table table-striped data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Register</th>
                        <th>Nama Pasien</th>
                        <th>Tanggal Pemeriksaan</th>
                        <th>Diagnosis</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemeriksaans as $pemeriksaan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pemeriksaan->pasien->no_register }}</td>
                        <td>{{ $pemeriksaan->pasien->biodata->nama_lengkap }}</td>
                        <td>{{ Carbon\Carbon::parse($pemeriksaan->created_at)->isoFormat('LLLL') }}</td>
                        <td>{{ $pemeriksaan->diagnosis }}</td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection