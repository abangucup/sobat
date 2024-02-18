@extends('layouts.app')

@section('title', 'Obat')

@section('header', 'Data Obat')

@section('content')

<div class="card">

    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="display data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>No. Batch</th>
                        <th>Exp Date</th>
                        {{-- Box @ 100 Tablet --}}
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($obats as $obat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $obat->kode_obat }}</td>
                        <td>{{ $obat->nama_obat }}</td>
                        <td>{{ $obat->no_batch }}</td>
                        <td>{{ \Carbon\Carbon::parse($obat->tanggal_kedaluwarsa)->isoFormat('LL') }}</td>
                        <td>{{ $obat->satuan. ' @ '.$obat->kapasitas.' '. $obat->satuan_kapasitas }}</td>
                        <td>{{ $obat->stokObat->harga_beli }}</td>
                        <td>{{ $obat->stokObat->stok }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('distributor.show', $distributor->slug) }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Detail"
                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                        class="fa-solid fa-info"></i></a>
                                <a href="table-datatable-basic.html#" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Edit" class="btn btn-warning shadow btn-xs sharp me-1"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('obat.destroy', $obat->slug) }}" method="post">
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
                        <td colspan="9" class="text-center">Data Kosong</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection