@extends('layouts.app')

@section('title', 'Pemesanan Obat')

@section('header', 'Detail Pemesanan')

@section('content')
<div class="page-titles">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item ps-0"><a href="{{ route('pemesanan.index') }}">Daftar Pemesanan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Pesanan</li>
        </ol>
    </nav>
    <div class="text-end">
        @if ($pemesanan->status_kirim_naskah == 'pending')

        <form action="{{ route('surat.kirim', ['pemesanan_id' => $pemesanan->id]) }}" method="post">
            @csrf
            <button type="submit" class="btn btn-primary btn-xs"><i class="fa-solid fa-paper-plane me-2"></i>KIRIM
                KONSEP</button>
        </form>
        @else
        <button type="button" class="btn btn-primary btn-xs" disabled><i
                class="fa-regular fa-circle-check me-2"></i>Terkirim</button>
        </form>
        @endif
    </div>
</div>

<div class="col-lg-12">

    @foreach ($pemesanan->obats->groupBy('distributor.nama_perusahaan') as $distributor => $dataObat)

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Pesanan Untuk Distributor {{ $distributor }}</h4>
            <div class="text-end">
                <button class="btn btn-info btn-xs" type="button" data-bs-toggle="modal"
                    data-bs-target="#previewKonsep-{{ Str::slug($distributor) }}"><i
                        class="fa-solid fa-file-pdf me-2"></i>PREVIEW</button>
            </div>

        </div>

        {{-- MODAL PREVIEW --}}
        <div class="modal fade" id="previewKonsep-{{ Str::slug($distributor) }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Preview Konsep Surat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <iframe
                            src="{{ route('surat.konsep', ['pemesanan_id' => $pemesanan->id, 'distributor' => $distributor]) }}"
                            width="100%" height="100%"></iframe>
                    </div>
                </div>
            </div>
        </div>
        {{-- END MODAL PREVIEW --}}

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered verticle-middle table-responsive-sm">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA REAGEN/BHP/OBAT</th>
                            <th>BANYAK</th>
                            <th>SATUAN</th>
                            <th>HARGA</th>
                            <th>JUMLAH</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total = 0;
                        @endphp
                        @foreach ($dataObat as $obat)
                        @php
                        $detailPesanan = $obat->detailPesanans->where('pemesanan_id', $pemesanan->id)->first();
                        $total += $detailPesanan->harga_pesanan;
                        @endphp
                        <tr class="fw-bold">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $obat->nama_obat }}</td>
                            <td>{{ $detailPesanan->jumlah }}</td>
                            <td>{{ $obat->satuan . ' @ ' . $obat->kapasitas . ' ' . $obat->satuan_kapasitas}}</td>
                            <td>{{ 'Rp ' . number_format($obat->stokObats->where('lokasi',
                                'distributor')->first()->harga_jual, 0, ',', '.') }}</td>
                            <td>{{ 'Rp ' . number_format($detailPesanan->harga_pesanan, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                        <tr class="fw-bold bg-light">
                            <td colspan="5" class="text-center">TOTAL</td>
                            <td>{{ 'Rp ' . number_format($total, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="fw-bold bg-light">
                            <td colspan="5" class="text-center">PPN 11%</td>
                            <td>{{ 'Rp ' . number_format($total * 0.11, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="fw-bold bg-light">
                            <td colspan="5" class="text-center">TOTAL + PPN 11%</td>
                            <td>{{ 'Rp '. number_format(($total * 0.11) + $total, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endforeach

</div>
@endsection