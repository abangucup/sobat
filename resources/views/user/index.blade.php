@extends('layouts.app')

@section('title', 'Obat')

@section('content')
@extends('layouts.app')

@section('title', 'Obat')

@section('header', 'Data Obat')

@section('content')
@extends('layouts.app')

@section('title', 'Distributor')

@section('header', 'Data Distributor')

@section('content')

<div class="card">
    <div class="card-header">
        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target=".tambah-distributor"><i
                class="fa-regular fa-square-plus"></i> Tambah Distributor</button>
    </div>

    @include('distributor.modal_tambah')

    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="display data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Email</th>
                        <th>Instansi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->biodata->nama_lengkap }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role !== 'distributor' ? 'RSUD OTANAHA' :
                            $user->akunDistributor->distributor->nama_perusahaan }}</td>
                        <td>
                            <div class="d-flex">

                                <a href="table-datatable-basic.html#" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Edit" class="btn btn-warning shadow btn-xs sharp me-1"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                        class="btn btn-danger shadow btn-xs sharp">
                                        <i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Data Kosong</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Email</th>
                        <th>Instansi</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
@endsection
@endsection