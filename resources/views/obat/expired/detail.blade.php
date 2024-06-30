@extends('layouts.app')

@section('title', 'Pengembalian')

@section('header', 'Detail Pengajuan - '.$dataObat->obat->nama_obat)

@section('content')

<div class="page-titles">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item ps-0"><a href="{{ route('expired.index') }}">Detail Pengembalian</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $dataObat->obat->nama_obat }}</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-sm-12">
        <div class="card shadow-sm">
            <div class="card-header border-0 pb-0">
                <h2 class="card-title">DETAIL</h2>
                @if ($user->role == 'distributor' && $dataObat->expired->status_pengembalian == 'pending')
                <button class="text-end btn btn-xs btn-primary" data-bs-toggle="modal"
                    data-bs-target="#balas-{{ $dataObat->obat->slug }}">Setujui</button>
                {{-- MODAL VERIF PENGEMBALIAN --}}
                <div class="modal fade tampil-modal" id="balas-{{ $dataObat->obat->slug }}" tabindex="-1" role="dialog"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Kirim Balasan</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>
                            <form action="{{ route('expired.balasan', $dataObat->expired->id) }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Tambahkan Balasan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea name="balasan" class="form-control" rows="4" required
                                            placeholder="Tambahkan catatan jika perlu"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger light"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- END MODAL --}}
                @endif

                @if ($user->role == 'gudang' && $dataObat->expired->status_pengembalian !== 'selesai')
                <form action="{{ route('expired.statusSelesai', $dataObat->expired->id) }}" method="post">
                    @csrf
                    <button class="text-end btn btn-xs btn-success" type="submit">Verif Selesai</button>
                </form>
                @endif
            </div>
            <div class="card-body pb-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>REAGEN/BHP/OBAT</strong>
                        <span class="mb-0">{{ $dataObat->obat->nama_obat }}</span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>TANGGAL EXPIRED</strong>
                        <span class="mb-0">{{ $dataObat->obat->tanggal_kedaluwarsa }}</span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>SATUAN</strong>
                        <span class="mb-0">{{ $dataObat->obat->satuan. ' @ '.$dataObat->obat->kapasitas.' '.
                            $dataObat->obat->satuan_kapasitas }}</span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>HARGA BELI</strong>
                        <span class="mb-0">{{ 'Rp. ' . number_format($dataObat->harga_beli, 0, ',', '.') }}</span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>TANGGAL PEMBELIAN</strong>
                        <span class="mb-0">{{ Carbon\Carbon::parse($dataObat->tanggal_beli)->isoFormat('LL') }}</span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>BANYAK OBAT</strong>
                        <span class="mb-0">{{ $dataObat->jumlah_stok_isi . ' '.$dataObat->obat->satuan_kapasitas }}</span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>TANGGAL PENGAJUAN PENGEMBALIAN</strong>
                        <span class="mb-0">{{ Carbon\Carbon::parse($dataObat->expired->created_at)->isoFormat('LL')
                            }}</span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>LOKASI OBAT</strong>
                        <span class="mb-0">{{ Str::ucfirst($dataObat->lokasi) }}</span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>STATUS PENGEMBALIAN</strong>
                        <span class="mb-0">
                            {{ Str::ucfirst($dataObat->expired->status_pengembalian) }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>CATATAN PENGAJU</strong>
                        <span class="mb-0">{{ $dataObat->expired->catatan ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>BALASAN DISTRIBUTOR</strong>
                        <span class="mb-0">{{ $dataObat->expired->balasan ?? '-' }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection