@extends('layouts.app')

@section('title', 'Laporan Pemakaian')

@section('header', 'Laporan Pemakain Obat')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Laporan obat keluar</h3>
        <a href="{{ route('cetak.laporanKeuangan') }}" target="_blank" class="btn btn-sm btn-danger text-end"><i
                class="fa-solid fa-print me-2"></i>Cetak Laporan</a>
    </div>

    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="table table-striped data-table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>PASIEN</th>
                        <th>REAGEN/BHP/OBAT</th>
                        <th>EXP. DATE</th>
                        <th>SATUAN</th>
                        <th>PEMAKAIAN</th>
                        <th>SISA STOK</th>
                        <th>PENDAPATAN</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($obatKeluars as $pemakaian)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pemakaian->pemeriksaan->pasien->biodata->nama_lengkap }}</td>
                        <td>{{ $pemakaian->stokObat->obat->nama_obat }}</td>
                        <td>{{ Carbon\Carbon::parse($pemakaian->stokObat->obat->tanggal_kedaluwarsa)->isoFormat('LL') }}
                        </td>
                        <td>{{ $pemakaian->stokObat->obat->satuan. ' @ '.$pemakaian->stokObat->obat->kapasitas.' '.
                            $pemakaian->stokObat->obat->satuan_kapasitas }}</td>
                        <td>{{ $pemakaian->jumlah }}</td>
                        <td>{{ $pemakaian->stokObat->stok }}</td>
                        <td>{{ 'Rp. '. number_format($pemakaian->stokObat->harga_jual,0,',','.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection