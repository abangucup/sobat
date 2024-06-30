@extends('layouts.app')

@section('title', 'Pemakain Obat')

@section('header', 'Daftar Pemakain')

@section('content')

<div class="card">
    <div class="card-header">
        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambahPemakaian"><i
                class="fa-regular fa-square-plus"></i> Tambah Pemakain</button>
    </div>

    @include('pemakaian.modal_tambah')

    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="table table-striped data-table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>REAGEN/BHP/OBAT</th>
                        <th>BANYAK</th>
                        <th>TANGGAL PAKAI</th>
                        <th>CATATAN</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($pemakaians as $pemakaian)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pemakaian->stokObat->obat->nama_obat }}</td>
                        <td>{{ $pemakaian->banyak . ' '.$pemakaian->stokObat->obat->satuan_kapasitas }}</td>
                        <td>{{ Carbon\Carbon::parse($pemakaian->tanggal_pemakaian)->isoFormat('LL') }}</td>
                        <td>{{ $pemakaian->catatan ?? '-' }}</td>
                        <td>
                            <div class="d-flex">
                                <button type="button" data-bs-toggle="modal" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-target="#ubahPemakaian-{{ $pemakaian->id }}"
                                    title="Ubah" class="btn btn-warning shadow btn-xs sharp me-1"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                                <form action="{{ route('pemakaian.destroy', $pemakaian->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                        class="btn btn-danger shadow btn-xs sharp">
                                        <i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    @include('pemakaian.modal_ubah')

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection