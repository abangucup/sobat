@extends('layouts.app')

@section('title', 'Pemesanan Obat')

@section('header', 'Pesanan Diproses')

@section('content')

<div class="card">
    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="table table-bordered table-responsive-sm">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Distributor</th>
                        <th rowspan="2">Obat</th>
                        <th rowspan="2">Jumlah</th>
                        <th rowspan="2">Harga</th>
                        <th colspan="3" class="text-center">Status Verif</th>
                        <th rowspan="2">Status Selesai</th>
                    </tr>
                    <tr>
                        <th>PPK</th>
                        <th>DIREKTUR</th>
                        <th>DISTRIBUTOR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="2">1</td>
                        <td rowspan="2">PT KIMIA FARMA</td>
                        <td>Parecetamol</td>
                        <td>Pcs</td>
                        <td>10000</td>
                        <td rowspan="2"><a href="" class="bgl-warning px-4 rounded">Belum</a></td>
                        <td rowspan="2"><a href="" class="bgl-warning px-4 rounded">Belum</a></td>
                        <td rowspan="2"><a href="" class="bgl-warning px-4 rounded">Belum</a></td>
                        <td rowspan="2"><a href="" class="bgl-warning px-4 rounded">Belum</a></td>
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
                        <th>Distributor</th>
                        <th>Obat</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>PPK</th>
                        <th>DIREKTUR</th>
                        <th>DISTRIBUTOR</th>
                        <th>Status Selesai</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection