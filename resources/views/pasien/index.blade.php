@extends('layouts.app')

@section('title', 'Pasien')

@section('header', 'Data Pasien')

@section('content')

<div class="card">

    <div class="card-header">
        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambahPasien"><i
                class="fa-regular fa-square-plus"></i> Tambah Pasien</button>
    </div>

    @include('pasien.modal_tambah')

    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="table table-striped data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Register</th>
                        <th>Nama Pasien</th>
                        <th>Telp</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pasiens as $pasien)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pasien->no_register }}</td>
                        <td>{{ $pasien->biodata->nama_lengkap }}</td>
                        <td>{{ $pasien->biodata->no_hp ?? '-' }}</td>
                        <td>{{ $pasien->biodata->jenis_kelamin == 'l' ? 'Laki Laki' : 'Perempuan' }}</td>
                        <td>{{ Carbon\Carbon::parse($pasien->biodata->tanggal_lahir)->isoFormat('LL') }}</td>
                        <td>{{ $pasien->biodata->alamat }}</td>

                        <td>
                            <div class="d-flex">
                                <button data-bs-toggle="modal" data-bs-target="#editPasien-{{ $pasien->no_register }}"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                    class="btn btn-warning shadow btn-xs sharp me-1"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                                <form action="{{ route('pasien.destroy', $pasien->no_register) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                        class="btn btn-danger shadow btn-xs sharp">
                                        <i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    @include('pasien.modal_edit')

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
