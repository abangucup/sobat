@extends('layouts.app')

@section('title', 'Pemesanan Obat')

@section('header', 'Pesanan Selesai')

@section('content')

<div class="card">
    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="table table-bordered data-table text-center" width="100%">
                <thead class="align-middle">
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Pemesan</th>
                        <th rowspan="2">Tanggal Pemesanan</th>
                        <th colspan="2">Status Verif</th>
                        <th rowspan="2">Status Pengiriman</th>
                        <th rowspan="2">Status Pesanan</th>
                        <th rowspan="2">Aksi</th>
                    </tr>
                    <tr>
                        <th>PPK</th>
                        <th>DIREKTUR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemesanans as $pemesanan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ optional($pemesanan->user->biodata)->nama_lengkap }}</td>
                        <td>{{ \Carbon\Carbon::parse($pemesanan->created_at)->isoFormat('LL') }}</td>
                        <td>
                            <span
                                class="badge badge-pill badge-{{ ($pemesanan->status_verif_ppk == 'pending') ? 'danger' : 'success' }}">
                                {{ Str::ucfirst($pemesanan->status_verif_ppk) }}<span>
                        </td>
                        <td>
                            <span
                                class="badge badge-pill badge-{{ ($pemesanan->status_verif_direktur == 'pending') ? 'danger' : 'success' }}">
                                {{ Str::ucfirst($pemesanan->status_verif_direktur) }}</span>
                        </td>
                        <td>
                            <span class="badge badge-pill badge-success">Selesai</span>
                        </td>
                        <td>
                            <span
                                class="badge badge-pill badge-{{ $pemesanan->status_pemesanan == 'pending'  ? 'danger' : ($pemesanan->status_pemesanan == 'proses' ? 'warning' : 'success') }}">
                                {{ Str::ucfirst($pemesanan->status_pemesanan) }}</span>
                        <td>
                            <a href="{{ route('pemesanan-selesai.detail', $pemesanan->id) }}"><span
                                    class="badge badge-pill badge-primary"><i
                                        class="fa-solid fa-circle-info me-2"></i>Detail</span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection