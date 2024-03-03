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
                        <th>Distributor</th>
                        <th>Obat</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="2">1</td>
                        <td rowspan="2">PT KIMIA FARMA</td>
                        <td>Parecetamol</td>
                        <td>Pcs</td>
                        <td>10000</td>
                        <td rowspan="2"><a href="">Lihat File</a></td>
                        <td>
                            <div class="d-flex">
                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"
                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                        class="fa-solid fa-info"></i></a>
                                <button type="button" data-bs-toggle="modal" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-target="#ubahDistributor-" title="Ubah"
                                    class="btn btn-warning shadow btn-xs sharp me-1"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                                <form action="#" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                        class="btn btn-danger shadow btn-xs sharp">
                                        <i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Ampicilin</td>
                        <td>Botol</td>
                        <td>20000</td>
                        <td>
                            <div class="d-flex">
                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"
                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                        class="fa-solid fa-info"></i></a>
                                <button type="button" data-bs-toggle="modal" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-target="#ubahDistributor-" title="Ubah"
                                    class="btn btn-warning shadow btn-xs sharp me-1"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                                <form action="#" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                        class="btn btn-danger shadow btn-xs sharp">
                                        <i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Perusahaan</th>
                        <th>Pemilik Perusahaan</th>
                        <th>Telepon Perusahaan</th>
                        <th>Lokasi Perusahaan</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection