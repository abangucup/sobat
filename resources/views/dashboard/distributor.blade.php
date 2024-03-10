@extends('layouts.app')

@section('title', 'Dashboard')

@section('header', 'Dashboard')


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
        <div class="widget-stat card bg-success">
            <div class="card-body  p-4">
                <div class="media">
                    <span class="me-3">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                    </span>
                    <div class="media-body text-white text-end">
                        <p class="mb-1 text-white">TOTAL OBAT TERJUAL</p>
                        <h3 class="text-white">1000</h3>
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
                        <h3 class="text-white">1000</h3>
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
                        <p class="mb-1 text-white">TOTAL PESANAN</p>
                        <h3 class="text-white">1000</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-success">
            <div class="card-body  p-4">
                <div class="media">
                    <span class="me-3">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </span>
                    <div class="media-body text-white text-end">
                        <p class="mb-1 text-white">KEUANGAN</p>
                        <a class="text-white h3" href="{{ route('permintaan.index') }}">1000</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-lg-7">
        <div class="card bgl-primary">
            <div class="card-header">
                <h4 class="card-title">PEMESANAN TERBARU</h4>
                <div class="text-end">
                    <a href="{{ route('pemesanan.daftar-pesanan') }}" class="btn btn-xs btn-primary">Cek Pesanan</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th>Jumlah Obat</th>
                                <th>Satuan</th>
                                <th>Tanggal Pemesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanans as $pesanan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pesanan->obat->nama_obat }}</td>
                                <td>{{ $pesanan->jumlah }}</td>
                                <td>{{ $pesanan->obat->satuan . ' @ ' . $pesanan->obat->kapasitas . ' ' .
                                    $pesanan->obat->satuan_kapasitas}}</td>
                                <td>{{ \Carbon\Carbon::parse($pesanan->pemesanan->created_at)->isoFormat('LL') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th>Jumlah Obat</th>
                                <th>Satuan</th>
                                <th>Tanggal Permintaan</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-5">
        <div class="card bgl-primary">
            <div class="card-header">
                <h4 class="card-title">PENGEMBALIAN OBAT TERBARU</h4>
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
                            <tr>
                                <td>Aminefron</td>
                                <td>12 Maret 2024</td>
                                <td>Pelayanan</td>
                            </tr>
                            <tr>
                                <td>Betason-N</td>
                                <td>12 Maret 2024</td>
                                <td>Gudang Farmasi</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Obat</th>
                                <th>Tanggal Kedaluwarsa</th>
                                <th>Lokasi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection