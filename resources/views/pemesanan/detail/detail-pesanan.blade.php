@extends('layouts.app')

@section('title', 'Pemesanan Obat')

@section('header', 'Detail Proses Pemesanan')

@section('content')
<div class="page-titles">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item ps-0"><a href="{{ route('pemesanan.proses') }}">Daftar Pemesanan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Status Proses Pesanan</li>
        </ol>
    </nav>
</div>

<div class="col-lg-12">

    {{-- @foreach ($pemesanan->detailPesanans->obat->groupBy('distributor.nama_perusahaan') as $distributor =>
    $dataObat) --}}
    @foreach ($pemesanan->detailPesanans->groupBy('obat.distributor.nama_perusahaan') as $distributor =>
    $detailPesanans)

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Pesanan Obat {{ $distributor }}</h4>
            <div class="text-end">
                <button class="btn btn-info btn-xs" type="button" data-bs-toggle="modal"
                    data-bs-target="#previewSurat-{{ Str::slug($distributor) }}"><i
                        class="fa-solid fa-file-pdf me-2"></i>PREVIEW</button>
            </div>

        </div>

        {{-- MODAL PREVIEW --}}
        <div class="modal fade" id="previewSurat-{{ Str::slug($distributor) }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Surat Pemesanan Obat {{ $distributor }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <iframe
                            src="{{ route('surat.status', ['pemesanan_id' => $pemesanan->id, 'distributor' => $distributor]) }}"
                            width="100%" height="100%"></iframe>
                    </div>
                </div>
            </div>
        </div>
        {{-- END MODAL PREVIEW --}}

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center table-responsive-sm">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA REAGEN/BHP/OBAT</th>
                            <th>BANYAK</th>
                            <th>SATUAN</th>
                            <th>HARGA</th>
                            <th>JUMLAH</th>
                            <th>VERIF</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detailPesanans as $detailPesanan )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detailPesanan->obat->nama_obat }}</td>
                            <td>{{ $detailPesanan->jumlah . ' '.$detailPesanan->obat->satuan }}</td>
                            <td>{{ $detailPesanan->obat->satuan . ' @ ' . $detailPesanan->obat->kapasitas . ' ' .
                                $detailPesanan->obat->satuan_kapasitas}}</td>
                            <td>
                                {{ 'Rp ' .
                                number_format($detailPesanan->obat->stokObats->where('lokasi','distributor')->first()->harga_jual,
                                0,
                                ',', '.') }}
                            </td>
                            <td>{{ 'Rp ' . number_format($detailPesanan->harga_pesanan, 0, ',', '.') }}</td>
                            <td>
                                @if ( auth()->user()->role == 'gudang' && !$detailPesanan->verif &&
                                $detailPesanan->status_pengiriman == 'dikirim')
                                <button class="btn btn-primary btn-xs" data-bs-toggle="modal"
                                    data-bs-target="#verif-{{ Str::slug($detailPesanan->id) }}">Verif Selesai</button>

                                {{-- MODAL VERIFIKASI PESANAN SELESAI --}}
                                <div class="modal fade text-start" id="verif-{{ Str::slug($detailPesanan->id) }}"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('verif.pesanan', $detailPesanan->id) }}"
                                                method="post">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Verifikasi Pesanan
                                                        Selesai
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Kondisi Pesanan
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="kondisi_pesanan"
                                                            class="form-select default-select" required>
                                                            <option value="" selected disabled>-- Pilih Kondisi Pesanan
                                                                --
                                                            </option>
                                                            <option value="sesuai">Sesuai</option>
                                                            <option value="tidak_sesuai">Tidak Sesuai</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <label>Tambahkan Catatan</label>
                                                        <textarea class="form-control" name="catatan" rows="3"
                                                            placeholder="Jumlah sudah sesuai yang diantarkan"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-outline-danger" data-bs-dismiss="modal"
                                                        type="button">Close</button>
                                                    <button class="btn btn-outline-primary"
                                                        type="submit">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- END MODAL VERIFIKASI PESANAN SELESAI --}}

                                @elseif ($detailPesanan->verif)
                                <button class="btn btn-xs btn-success" data-bs-toggle="modal"
                                    data-bs-target="#lihatVerif-{{ $detailPesanan->verif->id }}">Lihat
                                    Verifikasi</button>

                                {{-- MODAL LIHAT HASIL VERIF --}}
                                <div class="modal fade text-start"
                                    id="lihatVerif-{{ Str::slug($detailPesanan->verif->id) }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hasil Verif
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Kondisi Pesanan
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select class="form-select default-select">
                                                        <option value="{{ $detailPesanan->verif->kondisi_pesanan }}"
                                                            selected disabled>{{
                                                            Str::ucfirst($detailPesanan->verif->kondisi_pesanan) }}
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label>Tambahkan Catatan</label>
                                                    <textarea class="form-control" rows="3"
                                                        placeholder="Jumlah sudah sesuai yang diantarkan"
                                                        disabled>{{ $detailPesanan->verif->catatan ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- END MODAL LIHAT HASIL VERIF --}}

                                @else
                                <button class="btn btn-xs btn-light" disabled>Pesanan Belum Sampai</button>
                                @endif

                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endforeach

</div>
@endsection