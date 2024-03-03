@extends('layouts.app')

@section('title', 'Pemesanan Obat')

@section('header', 'Daftar Pemesanan')

@section('content')

<div class="card">
    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="table table-bordered table-responsive-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Obat</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>File</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="2">1</td>
                        <td>Parecetamol</td>
                        <td>Pcs</td>
                        <td>10000</td>
                        <td rowspan="2"><a href="">Lihat File</a></td>
                        <td rowspan="2">13 Januari 2024</td>
                        <td rowspan="2"><a href="#">Verifikasi Pengantaran</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Ampicilin</td>
                        <td>Botol</td>
                        <td>20000</td>

                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        {{-- <th>Nama Perusahaan</th> --}}
                        <th>Pemilik Perusahaan</th>
                        <th>Telepon Perusahaan</th>
                        <th>Lokasi Perusahaan</th>
                        <th>File</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection