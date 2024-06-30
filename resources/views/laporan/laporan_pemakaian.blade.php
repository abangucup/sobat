@extends('layouts.app')

@section('title', 'Laporan Pemakaian')

@section('header', 'Laporan Pemakain Obat')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Laporan obat terpakai</h3>
        <a href="{{ route('cetak.laporanPemakaian') }}" target="_blank" class="btn btn-sm btn-danger text-end"><i
                class="fa-solid fa-print me-2"></i>Cetak Laporan</a>
    </div>

    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="table table-striped data-table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>REAGEN/BHP/OBAT</th>
                        <th>NO. BATCH</th>
                        <th>EXP. DATE</th>
                        <th>SATUAN</th>
                        <th>PENGGUNAAN</th>
                        <th>TANGGAL PAKAI</th>
                        <th>SISA STOK</th>
                        <th>LOKASI</th>
                        <th>CATATAN</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($pemakaians as $pemakaian)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pemakaian->stokObat->obat->nama_obat }}</td>
                        <td>{{ $pemakaian->stokObat->obat->no_batch }}</td>
                        <td>{{ Carbon\Carbon::parse($pemakaian->stokObat->obat->tanggal_kedaluwarsa)->isoFormat('LL') }}</td>
                        <td>{{ $pemakaian->stokObat->obat->satuan. ' @ '.$pemakaian->stokObat->obat->kapasitas.' '.
                            $pemakaian->stokObat->obat->satuan_kapasitas }}</td>
                        <td>{{ $pemakaian->banyak. ' '.$pemakaian->stokObat->obat->satuan_kapasitas }}</td>
                        <td>{{ Carbon\Carbon::parse($pemakaian->tanggal_pemakaian)->isoFormat('LL') }}</td>
                        <td>{{ $pemakaian->stokObat->jumlah_stok_isi . ' '.$pemakaian->stokObat->obat->satuan_kapasitas  }}</td>
                        <td>{{ Str::upper($pemakaian->stokObat->lokasi) }}</td>
                        <td>{{ $pemakaian->catatan ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection