@extends('layouts.app')

@section('title', 'Pemeriksaan')

@section('header', 'Edit Pemeriksaan')

@section('content')

<div class="row">
    <div class="page-titles">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item ps-0"><a href="{{ route('pemeriksaan.index') }}">Pemeriksaan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-xl-5">
            <div class="card shadow-sm h-auto">
                <div class="card-header border-0 pb-0">
                    <h2 class="card-title">{{ $pemeriksaan->pasien->no_register }}</h2>
                </div>
                <div class="card-body pb-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex px-0 justify-content-between">
                            <strong>No Register</strong>
                            <span class="mb-0">{{ $pemeriksaan->pasien->biodata->nama_lengkap }}</span>
                        </li>
                        <li class="list-group-item d-flex px-0 justify-content-between">
                            <strong>Tanggal Lahir</strong>
                            <span class="mb-0">{{
                                Carbon\Carbon::parse($pemeriksaan->pasien->biodata->tanggal_lahir)->isoFormat('LL')
                                }}</span>
                        </li>
                        <li class="list-group-item d-flex px-0 justify-content-between">
                            <strong>Jenis Kelamin</strong>
                            <span class="mb-0">{{ $pemeriksaan->pasien->biodata->jenis_kelamin == 'l' ? 'Laki-Laki' :
                                'Perempuan' }}</span>
                        </li>
                        <li class="list-group-item d-flex px-0 justify-content-between">
                            <strong>Tanggal Pemeriksaan</strong>
                            <span class="mb-0">{{ Carbon\Carbon::parse($pemeriksaan->created_at)->isoFormat('LL')
                                }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-7">
            <div class="card shadow-sm h-auto">
                <div class="card-header border-0 pb-0">
                    <button data-bs-target="#tambahResep" data-bs-toggle="modal" class="btn btn-sm btn-outline-primary">
                        <i class="fa-regular fa-square-plus"></i> Tambah Resep
                    </button>
                </div>
                @include('pemeriksaan.resep.modal_tambah')
                <div class="card-body pb-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Obat</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reseps as $resep)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $resep->stokObat->obat->nama_obat }}</td>
                                    <td>{{ $resep->jumlah }}</td>
                                    <td>{{ $resep->keterangan }}</td>

                                    <td>
                                        <div class="d-flex">
                                            <form action="{{ route('pemeriksaan.destroyResep', ['pemeriksaan_id' => $resep->pemeriksaan_id, 'id' => $resep->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Hapus" class="btn btn-danger shadow btn-xs sharp">
                                                    <i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Kosong</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection