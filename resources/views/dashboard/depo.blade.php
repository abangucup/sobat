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
                        <p class="mb-1 text-white">TOTAL PESANAN SELESAI</p>
                        <h3 class="text-white">1000</h3>
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
                        <h3 class="text-white">1000</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-secondary">
            <div class="card-body  p-4">
                <div class="media">
                    <span class="me-3">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </span>
                    <div class="media-body text-white text-end">
                        <p class="mb-1 text-white">PERMINTAAN DIPROSES</p>
                        <a class="text-white h3" href="{{ route('permintaan.index') }}">1000</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-primary">
            <div class="card-body  p-4">
                <div class="media">
                    <span class="me-3">
                        <i class="fa-solid fa-check-double"></i>
                    </span>
                    <div class="media-body text-white text-end">
                        <p class="mb-1 text-white">PERMINTAAN DISETUJUI</p>
                        <a class="text-white h3" href="{{ route('permintaan.index') }}">1000</a>
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
@endsection