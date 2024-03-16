@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-primary">
            <div class="card-body  p-4">
                <div class="media">
                    <span class="me-3">
                        <i class="fa-solid fa-capsules"></i>
                    </span>
                    <div class="media-body text-white text-end">
                        <p class="mb-1 text-white">TOTAL OBAT</p>
                        <h3 class="text-white">{{ $totalObat }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-danger">
            <div class="card-body  p-4">
                <div class="media">
                    <span class="me-3">
                        <i class="fa-solid fa-skull"></i>
                    </span>
                    <div class="media-body text-white text-end">
                        <p class="mb-1 text-white">TOTAL OBAT EXPIRED</p>
                        <h3 class="text-white">{{ $totalExpired }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-warning">
            <div class="card-body  p-4">
                <div class="media">
                    <span class="me-3">
                        <i class="fa-solid fa-check-double"></i>
                    </span>
                    <div class="media-body text-white text-end">
                        <p class="mb-1 text-white">TOTAL PESANAN SELESAI</p>
                        <a href="{{ route('pemesanan.selesai') }}" class="h3 text-white">{{ $totalPesananSelesai }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-info">
            <div class="card-body  p-4">
                <div class="media">
                    <span class="me-3">
                        <i class="fa-solid fa-hourglass-half"></i>
                    </span>
                    <div class="media-body text-white text-end">
                        <p class="mb-1 text-white">PESANAN STATUS PROSES</p>
                        <a class="h3 text-white" href="{{ route('pemesanan.proses') }}">{{ $totalPesananProses }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-xxl-6 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-secondary">
            <div class="card-body  p-4">
                <div class="media">
                    <span class="me-3">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </span>
                    <div class="media-body text-white text-end">
                        <p class="mb-1 text-white">PERMINTAAN DIPROSES</p>
                        <a class="text-white h3" href="{{ route('permintaan.tunda') }}">{{ $totalPermintaanProses }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-xxl-6 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-primary">
            <div class="card-body  p-4">
                <div class="media">
                    <span class="me-3">
                        <i class="fa-solid fa-check-double"></i>
                    </span>
                    <div class="media-body text-white text-end">
                        <p class="mb-1 text-white">PERMINTAAN DISETUJUI</p>
                        <a class="text-white h3" href="{{ route('permintaan.setuju') }}">{{ $totalPermintaanSelesai
                            }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="card bgl-primary">
            <div class="card-header">
                <h4 class="card-title">PERMINTAAN TERBARU</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Nama Obat</th>
                                <th>Bidang</th>
                                <th>Jumlah Obat</th>
                                <th>Tanggal Permintaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($permintaans as $permintaan)
                            <tr>
                                <td>{{ $permintaan->stokObat->obat->nama_obat }}</td>
                                <td>{{ Str::ucfirst($permintaan->bidang) }}</td>
                                <td>{{ $permintaan->banyak }}</td>
                                <td>{{ Carbon\Carbon::parse($permintaan->created_at)->isoFormat('LL') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="text-align: center">Kosong</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="card bgl-primary">
            <div class="card-header">
                <h4 class="card-title">OBAT EXPIRED</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Nama Obat</th>
                                <th>Tanggal Kedaluwarsa</th>
                                <th>Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($obatExpireds as $dataObat)
                            <tr>
                                <td>{{ $dataObat->obat->nama_obat }}</td>
                                <td>
                                    {{
                                    Carbon\Carbon::parse($dataObat->obat->tanggal_kedaluwarsa)->isoFormat('LL') }}
                                </td>
                                <td>{{ Str::ucfirst($dataObat->lokasi) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection