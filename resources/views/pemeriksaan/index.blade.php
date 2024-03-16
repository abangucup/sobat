@extends('layouts.app')

@section('title', 'Pemeriksaan')

@section('header', 'Data Pemeriksaan')

@section('content')

<div class="card">

    <div class="card-header">
        <a href="{{ route('pemeriksaan.create') }}" class="btn btn-sm btn-outline-primary">
            <i class="fa-regular fa-square-plus"></i> Tambah Pemeriksaan
        </a>
    </div>

    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="table table-striped data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Register</th>
                        <th>Nama Pasien</th>
                        <th>Tanggal Pemeriksaan</th>
                        <th>Diagnosis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemeriksaans as $pemeriksaan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pemeriksaan->pasien->no_register }}</td>
                        <td>{{ $pemeriksaan->pasien->biodata->nama_lengkap }}</td>
                        <td>{{ Carbon\Carbon::parse($pemeriksaan->created_at)->isoFormat('LLLL') }}</td>
                        <td>{{ $pemeriksaan->diagnosis }}</td>

                        <td>
                            <div class="d-flex">
                                <a href="{{ route('pemeriksaan.show', $pemeriksaan->id) }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Detail"
                                    class="btn btn-primary shadow btn-xs sharp me-1">
                                    <i class="fa-solid fa-circle-info"></i></a>
                                <a href="{{ route('pemeriksaan.edit', $pemeriksaan->id) }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Edit"
                                    class="btn btn-warning shadow btn-xs sharp me-1"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('pemeriksaan.destroy', $pemeriksaan->id) }}" method="post">
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
            </table>
        </div>
    </div>
</div>
@endsection