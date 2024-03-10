@extends('layouts.app')

@section('title', 'Pemesanan Obat')

@section('header', 'Pesanan Diproses')

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
                            @if ($user->role == 'ppk' && $pemesanan->status_verif_ppk == 'pending')
                            <form action="{{ route('verif.ppk', $pemesanan->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-xs" name="status_verif_ppk"
                                    value="diverifikasi">Setujui</button>
                                <button type="submit" class="btn btn-danger btn-xs" name="status_verif_ppk"
                                    value="ditolak">Tolak</button>
                            </form>
                            @else
                            <span
                                class="badge badge-pill badge-{{ $pemesanan->status_verif_ppk == 'diverifikasi' ? 'success' : 'danger' }}">
                                @if ($pemesanan->status_verif_ppk == 'diverifikasi')
                                <i class="fa-solid fa-check me-2"></i>
                                @else
                                <i class="fa-solid fa-xmark me-2"></i>
                                @endif
                                {{ Str::ucfirst($pemesanan->status_verif_ppk) }}
                                <span>
                                    @endif

                        </td>
                        <td>
                            @if ($user->role == 'direktur' && $pemesanan->status_verif_direktur == 'pending' &&
                            $pemesanan->status_verif_ppk == 'diverifikasi')
                            <form action="{{ route('verif.direktur', $pemesanan->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-xs" name="status_verif_direktur"
                                    value="diverifikasi">Setujui</button>
                                <button type="submit" class="btn btn-danger btn-xs" name="status_verif_direktur"
                                    value="ditolak">Tolak</button>
                            </form>
                            @else
                            <span
                                class="badge badge-pill badge-{{ ($pemesanan->status_verif_direktur == 'diverifikasi') ? 'success' : 'danger' }}">
                                @if ($pemesanan->status_verif_direktur == 'diverifikasi')
                                <i class="fa-solid fa-check me-2"></i>
                                @else
                                <i class="fa-solid fa-xmark me-2"></i>
                                @endif
                                {{ Str::ucfirst($pemesanan->status_verif_direktur) }}
                            </span>
                            @endif
                        </td>
                        <td>
                            <span
                                class="badge badge-pill badge-{{ $pemesanan->status_pemesanan == 'pending'  ? 'danger' : ($pemesanan->status_pemesanan == 'proses' ? 'warning' : 'success') }}">
                                {{ Str::ucfirst($pemesanan->status_pemesanan) }}</span>
                        <td>
                            <a href="{{ route('pemesanan-proses.detail', $pemesanan->id) }}"><span
                                    class="badge badge-pill badge-primary"><i
                                        class="fa-solid fa-circle-info me-2"></i>Cek Pesanan</span></a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection