@extends('layouts.app')

@section('title', 'Detail Obat')

@section('header', 'Detail '.$obat->nama_obat)

@section('content')

<div class="row">
    <div class="page-titles">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item ps-0"><a href="{{ route('obat.index') }}">Data Obat</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>
    </div>

    <div class="card  shadow-sm">
        <div class="card-header border-0 pb-0">
            <h2 class="card-title">Detail - {{ $obat->nama_obat }}</h2>
        </div>
        <div class="card-body pb-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex px-0 justify-content-between">
                    <strong>Kode Obat</strong>
                    <span class="mb-0">{{ $obat->kode_obat }}</span>
                </li>
                <li class="list-group-item d-flex px-0 justify-content-between">
                    <strong>Nama Obat</strong>
                    <span class="mb-0">{{ $obat->nama_obat }}</span>
                </li>
                <li class="list-group-item d-flex px-0 justify-content-between">
                    <strong>Satuan</strong>
                    <span class="mb-0">{{ $obat->satuan . ' @ '. $obat->kapasitas. ' ' .
                        $obat->satuan_kapasitas}}</span>
                </li>
                <li class="list-group-item d-flex px-0 justify-content-between">
                    <strong>No. Batch</strong>
                    <span class="mb-0">{{ $obat->no_batch }}</span>
                </li>
                <li class="list-group-item d-flex px-0 justify-content-between">
                    <strong>Tanggal Kedaluwarsan</strong>
                    <span class="mb-0">{{ $obat->tanggal_kedaluwarsa }}</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="card  shadow-sm">
        <div class="card-header border-0 pb-0">
            <h2 class="card-title">Distributor - {{ $obat->distributor->nama_perusahaan }}</h2>
        </div>
        <div class="card-body pb-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex px-0 justify-content-between">
                    <strong>Nama Perusahaan</strong>
                    <span class="mb-0">{{ $obat->distributor->nama_perusahaan }}</span>
                </li>
                <li class="list-group-item d-flex px-0 justify-content-between">
                    <strong>Telepon Perusahaan</strong>
                    <span class="mb-0">{{ $obat->distributor->telepon_perusahaan }}</span>
                </li>
                <li class="list-group-item d-flex px-0 justify-content-between">
                    <strong>Pemilik Perusahaan</strong>
                    <span class="mb-0">{{ $obat->distributor->pemilik_perusahaan }}</span>
                </li>
                <li class="list-group-item d-flex px-0 justify-content-between">
                    <strong>Lokasi Perusahaan</strong>
                    <span class="mb-0">{{ $obat->distributor->lokasi_perusahaan }}</span>
                </li>
            </ul>
        </div>
    </div>


    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Lokasi Penyimpanan Obat</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Stok</th>
                            <th>Harga Beli</th>
                            <th>Tanggal Beli</th>
                            <th>Harga Jual</th>
                            <th>Lokasi Obat</th>
                            <th>Ditambahkan Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($obat->stokObats as $stokObat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $stokObat->stok }}</td>
                            <td>{{ 'Rp. '. number_format($stokObat->harga_beli, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($stokObat->tanggal_beli)->isoFormat('LL') }}</td>
                            <td>{{ 'Rp. '.number_format($stokObat->harga_jual, 0, ',', '.') }}</td>
                            <td>{{ Str::ucfirst($stokObat->lokasi) }}</td>
                            <td>{{ Carbon\Carbon::parse($stokObat->updated_at)->isoFormat('LL') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Stok</th>
                            <th>Harga Beli</th>
                            <th>Tanggal Beli</th>
                            <th>Harga Jual</th>
                            <th>Lokasi Obat</th>
                            <th>Ditambahkan Pada</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- <div class="col-md-6">
        <div class="card  shadow-sm">
            <div class="card-header border-0 pb-0">
                <h2 class="card-title">Persediaan</h2>
            </div>
            <div class="card-body pb-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>Distributor</strong>
                        <span class="mb-0">{{ $obat->stokObats->pluck('distributor')->first()->nama_perusahaan }}</span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>Stok</strong>
                        <span class="mb-0">{{ $obat->stokObats->first()->stok }}</span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>Harga Beli</strong>
                        <span class="mb-0"></span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>Operation Done</strong>
                        <span class="mb-0">120</span>
                    </li>
                </ul>
            </div>
            <div class="card-footer pt-0 pb-0 text-center">
                <div class="row">
                    <div class="col-4 pt-3 pb-3 border-end">
                        <h3 class="mb-1 text-primary">150</h3>
                        <span>Projects</span>
                    </div>
                    <div class="col-4 pt-3 pb-3 border-end">
                        <h3 class="mb-1 text-primary">140</h3>
                        <span>Uploads</span>
                    </div>
                    <div class="col-4 pt-3 pb-3">
                        <h3 class="mb-1 text-primary">45</h3>
                        <span>Tasks</span>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>

@endsection