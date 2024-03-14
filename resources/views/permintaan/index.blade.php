@extends('layouts.app')

@section('title', 'Permintaan Obat')

@section('header', 'Daftar Permintaan')

@section('content')

<div class="card">
    <div class="card-header">
        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambahPermintaan"><i
                class="fa-regular fa-square-plus"></i> Tambah Permintaan</button>
    </div>

    @include('permintaan.modal_tambah')

    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="table table-striped data-table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>REAGEN/BHP/OBAT</th>
                        <th>PENGAJU</th>
                        <th>PEMVERIFIKASI</th>
                        <th>BANYAK</th>
                        <th>STATUS PERMINTAAN</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($permintaans as $permintaan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $permintaan->stokObat->obat->nama_obat }}</td>
                        <td>{{ $permintaan->userPengaju->biodata->nama_lengkap }}</td>
                        <td>{{ $permintaan->userPemverifikasi->biodata->nama_lengkap ?? 'Belum diverifikasi' }}</td>
                        <td>{{ $permintaan->banyak }}</td>
                        <td>
                            <span
                                class="badge badge-{{ $permintaan->status_permintaan === 'disetujui' || $permintaan->status_permintaan === 'selesai' ? 'success' : 'danger' }}">
                                {{ Str::ucfirst($permintaan->status_permintaan)}}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex">
                                <button type="button" data-bs-toggle="modal" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-target="#ubahPermintaan-{{ $permintaan->id }}"
                                    title="Ubah" class="btn btn-warning shadow btn-xs sharp me-1"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                                <form action="{{ route('permintaan.destroy', $permintaan->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                        class="btn btn-danger shadow btn-xs sharp">
                                        <i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    @include('permintaan.modal_ubah')

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

{{-- @push('style')
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />

@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // $('.select2').select2();
        $("#pilihObat").select2({
            theme: "bootstrap-5",
        });
    });
</script>

@endpush --}}