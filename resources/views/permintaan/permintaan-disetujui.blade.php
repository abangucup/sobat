@extends('layouts.app')

@section('title', 'Pemesanan Obat')

@section('header', 'Permintaan Disetujui')

@section('content')

<div class="card">
    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="table table-bordered table-responsive-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bagian</th>
                        <th>Obat</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Pelayanan</td>
                        <td>Ampicilin</td>
                        <td>20</td>
                        <td>Rp. 20.000</td>
                        <td>Rp. 400.000</td>
                        <td><a href="" class="btn btn-success">Disetujui</a></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Bagian</th>
                        <th>Obat</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection