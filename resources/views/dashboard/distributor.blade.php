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
                            <tr>
                                <td>Paracetamol</td>
                                <td>Pelayanan</td>
                                <td>20 Tablet</td>
                                <td>13 Februari 2024</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Obat</th>
                                <th>Bidang</th>
                                <th>Jumlah Obat</th>
                                <th>Tanggal Permintaan</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
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