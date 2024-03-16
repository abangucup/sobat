@extends('layouts.app')

@section('title', 'Rekapan Keuangan')

@section('header', 'Laporan Rekap Keuangan')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Laporan Semua Rekapan Keuangan</h3>
        <a href="{{ route('cetak.keuanganDistributor') }}" target="_blank" class="btn btn-sm btn-danger text-end"><i
                class="fa-solid fa-print me-2"></i>Cetak Laporan</a>
    </div>

    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="table table-striped data-table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>PEMESAN</th>
                        <th>REAGEN/BHP/OBAT</th>
                        <th>NO. BATCH</th>
                        <th>SATUAN</th>
                        <th>QTY</th>
                        <th>TOTAL</th>
                        <th>PAJAK</th>
                        <th>JUMLAH</th>
                        <th>TANGGAL PESANAN</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                    $jumlah = 0;
                    @endphp
                    @foreach ($dataPesanans as $dataPesanan)
                    @php
                    $pajak = $dataPesanan->harga_pesanan * 0.11;
                    $total = $pajak + $dataPesanan->harga_pesanan;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dataPesanan->pemesanan->user->biodata->nama_lengkap }}</td>
                        <td>{{ $dataPesanan->obat->nama_obat }}</td>
                        <td>{{ $dataPesanan->obat->no_batch }}</td>
                        <td>{{ $dataPesanan->obat->satuan. ' @ '.$dataPesanan->obat->kapasitas.' '.
                            $dataPesanan->obat->satuan_kapasitas }}</td>
                        <td>{{ $dataPesanan->jumlah }}</td>
                        <td>{{ 'Rp. '. number_format($dataPesanan->harga_pesanan, 0, ',', '.') }}</td>
                        <td>{{ 'Rp. '. number_format($pajak, 0, ',', '.') }}</td>
                        <td>{{ 'Rp. '. number_format($total, 0, ',', '.') }}</td>
                        <td>{{ Carbon\Carbon::parse($dataPesanan->created_at)->isoFormat('LL') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection