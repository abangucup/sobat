@extends('layouts.app')

@section('title', 'Distributor')

@section('header', 'Detail Distributor - '.$distributor->nama_perusahaan)

@section('content')

<div class="page-titles">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item ps-0"><a href="{{ route('distributor.index') }}">Distributor</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $distributor->nama_perusahaan }}</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-xl-6 col-lg-12 col-sm-12">
        <div class="card shadow-sm">
            <div class="card-header border-0 pb-0">
                <h2 class="card-title">Data Perusahaan</h2>
            </div>
            <div class="card-body pb-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>Nama Perusahaan</strong>
                        <span class="mb-0">{{ $distributor->nama_perusahaan }}</span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>Pemilik Perusahaan</strong>
                        <span class="mb-0">{{ $distributor->pemilik_perusahaan }}</span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>Telepon Perusahaan</strong>
                        <span class="mb-0">{{ $distributor->telepon_perusahaan }}</span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>Lokasi Perusahaan</strong>
                        <span class="mb-0">{{ $distributor->lokasi_perusahaan }}</span>
                    </li>
                </ul>
            </div>
            <div class="card-footer pt-0 pb-0 text-center">
                <div class="row">
                    <div class="col-3 pt-3 pb-3 border-end">
                        <h3 class="mb-1 text-primary">150</h3>
                        <span>Total Obat</span>
                    </div>
                    <div class="col-3 pt-3 pb-3 border-end">
                        <h3 class="mb-1 text-primary">4</h3>
                        <span>Akun Distributor</span>
                    </div>
                    <div class="col-3 pt-3 pb-3 border-end">
                        <h3 class="mb-1 text-primary">45</h3>
                        <span>Total Pesanan</span>
                    </div>
                    <div class="col-3 pt-3 pb-3">
                        <h3 class="mb-1 text-primary">45</h3>
                        <span>TOtal Obat Expired</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-12 col-sm-12">
        <div class="card shadow-sm">
            <div class="card-header border-0 pb-0">
                <h2 class="card-title">List Akun Distributor</h2>
            </div>
            <div class="card-body pb-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Nama Petugas</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($distributor->akuns as $akun)
                            <tr>
                                <td>{{ $akun->user->biodata->nama_lengkap }}</td>
                                <td>{{ $akun->user->username }}</td>
                                <td>{{ $akun->user->email }}</td>
                                <td>{{ $akun->user->role }}</td>
                                {{-- <td>
                                    <div class="d-flex">
                                        <button type="button" data-bs-toggle="modal" data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-target="#ubahDistributor-{{ $akun->id }}"
                                            title="Ubah" class="btn btn-danger shadow btn-xs sharp me-1"><i
                                                class="fa-solid fa-pen-to-square"></i></button>
                                    </div>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Petugas</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Level</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection