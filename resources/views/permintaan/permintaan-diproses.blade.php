@extends('layouts.app')

@section('title', 'Permintaan Obat')

@section('header', 'Permintaan Menunggu Persetujuan')

@section('content')

<div class="card">
    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="table table-striped data-table text-center">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>REAGEN/BHP/OBAT</th>
                        <th>PENGAJU</th>
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
                        <td>{{ $permintaan->banyak. ' '.$permintaan->stokObat->obat->satuan }}</td>
                        @if ($permintaan->status_permintaan == 'tunda')
                        <td>
                            <form action="{{ route('permintaan.verif', $permintaan->id) }}" method="post">
                                @csrf
                                <button class="btn btn-xs btn-danger" type="submit" name="status_permintaan"
                                    value="ditolak">Tolak</button>
                                <button class="btn btn-xs btn-warning" type="submit" name="status_permintaan"
                                    value="disetujui">Setujui</button>
                            </form>
                        </td>
                        @else
                        <td>
                            <span
                                class="badge badge-{{ $permintaan->status_permintaan !== 'disetujui' ? 'danger' : 'warning' }}">
                                {{ Str::ucfirst($permintaan->status_permintaan)}}
                            </span>
                        </td>
                        @endif
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('permintaan.show', $permintaan->id) }}" title="Detail"
                                    class="btn btn-primary shadow btn-xs me-1">Detail</a>
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