@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
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
    
    <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
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
    <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
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
    
</div>

<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="card bgl-primary">
            <div class="card-header d-flex justify-content-between">

                <h4 class="card-title">PEMESANAN TERBARU</h4>
                <a href="{{ route('pemesanan.proses') }}" class="btn btn-primary">Cek</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Nama Obat</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemesanans as $pemesanan)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ Carbon\Carbon::parse($pemesanan->created_at)->isoFormat('LL')}}</td>
                                <td>
                                    <ul>
                                        @foreach ($pemesanan->obats as $obat)
                                        <li>{{ $obat->nama_obat }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $pemesanan->keterangan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Nama Obat</th>
                                <th>Keterangan</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection