@extends('layouts.app')

@section('title', 'Laporan Obat Keluar')

@section('header', 'Laporan Obat Keluar')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Laporan obat keluar</h3>
        <a href="{{ route('cetak.laporanObatKeluar') }}" target="_blank" class="btn btn-sm btn-danger text-end"><i
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
                        <th>DITEBUS</th>
                        <th>TANGGAL TEBUS</th>
                        <th>SISA STOK</th>
                        <th>LOKASI</th>
                        <th>CATATAN</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($obatKeluars as $obatKeluar)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $obatKeluar->stokObat->obat->nama_obat }}</td>
                        <td>{{ $obatKeluar->stokObat->obat->no_batch }}</td>
                        <td>{{ Carbon\Carbon::parse($obatKeluar->stokObat->obat->tanggal_kedaluwarsa)->isoFormat('LL') }}</td>
                        <td>{{ $obatKeluar->stokObat->obat->satuan. ' @ '.$obatKeluar->stokObat->obat->kapasitas.' '.
                            $obatKeluar->stokObat->obat->satuan_kapasitas }}</td>
                        <td>{{ $obatKeluar->jumlah . ' '. $obatKeluar->stokObat->obat->satuan_kapasitas }}</td>
                        <td>{{ Carbon\Carbon::parse($obatKeluar->pemeriksaan->tebusObat->updated_at)->isoFormat('LL') }}
                        </td>
                        <td>{{ $obatKeluar->stokObat->jumlah_stok_isi . ' '. $obatKeluar->stokObat->obat->satuan_kapasitas}}</td>
                        <td>{{ Str::upper($obatKeluar->stokObat->lokasi) }}</td>
                        <td class="wrap">{{ $obatKeluar->pemeriksaan->diagnosis ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection