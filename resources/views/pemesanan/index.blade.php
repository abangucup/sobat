@extends('layouts.app')

@section('title', 'Pemesanan Obat')

@section('header', 'Daftar Pemesanan')

@section('content')

<div class="card">
    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="display  data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Tanggal Pembuatan</th>
                        <th>Konsep Surat</th>
                        <th>Status Surat</th>
                        <th>Progress Surat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemesanans as $pemesanan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pemesanan->user->biodata->nama_lengkap }}</td>
                        <td>{{ \Carbon\Carbon::parse($pemesanan->created_at)->isoFormat('LL') }}</td>
                        <td>
                            <a href="{{ route('pemesanan.show', $pemesanan->id) }}"
                                class="badge badge-pill badge-primary"><i class="fa-solid fa-info me-2"></i>Lihat
                                Konsep</a>
                        </td>
                        <td>
                            <span
                                class="badge badge-pill badge-{{ $pemesanan->status_kirim_naskah == 'pending' ? 'danger' : 'success' }}">
                                {{ Str::ucfirst($pemesanan->status_kirim_naskah) }}</span>
                        </td>
                        <td>
                            @if ($pemesanan->status_kirim_naskah == 'pending')
                            <span class="badge badge-pill badge-danger">Pending</span>
                            @else
                            <a href="{{ route('pemesanan.proses') }}">Lihat Progress</a>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex">
                                <form action="{{ route('pemesanan.destroy', $pemesanan->id ) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                        class="btn btn-danger shadow btn-xs sharp">
                                        <i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Tanggal Pembuatan</th>
                        <th>Konsep Surat</th>
                        <th>Status Surat</th>
                        <th>Progress Surat</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection