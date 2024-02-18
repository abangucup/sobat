@extends('layouts.app')

@section('title', 'Distributor')

@section('header', 'Data Distributor')

@section('content')

<div class="card">
    <div class="card-header">
        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambahDistributor"><i
                class="fa-regular fa-square-plus"></i> Tambah Distributor</button>
    </div>

    @include('distributor.modal_tambah')

    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="display data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Perusahaan</th>
                        <th>Pemilik Perusahaan</th>
                        <th>Telepon Perusahaan</th>
                        <th>Lokasi Perusahaan</th>
                        <th>Akun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($distributors as $distributor)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $distributor->nama_perusahaan ?? '-' }}</td>
                        <td>{{ $distributor->pemilik_perusahaan ?? '-' }}</td>
                        <td>{{ $distributor->telepon_perusahaan ?? '-'}}</td>
                        <td>{{ $distributor->lokasi_perusahaan ?? '-'}}</td>
                        <td>
                            <span
                                class="badge light {{ $distributor->akuns->isEmpty() ? 'badge-warning' : 'badge-success' }}">
                                {{ $distributor->akuns->isEmpty() ? 'Tidak Tersedia' : ' Tersedia' }}</span>
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('distributor.show', $distributor->slug) }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Detail"
                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                        class="fa-solid fa-info"></i></a>
                                <button type="button" data-bs-toggle="modal" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-target="#ubahDistributor-{{ $distributor->id }}"
                                    title="Ubah" class="btn btn-warning shadow btn-xs sharp me-1"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                                <form action="{{ route('distributor.destroy', $distributor->slug) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                        class="btn btn-danger shadow btn-xs sharp">
                                        <i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- MODAL EDIT DATA DISTRIBUTOR --}}
                    <div class="modal fade tampil-modal" tabindex="-1" id="ubahDistributor-{{ $distributor->id }}"
                        role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Ubah Data - {{ $distributor->nama_perusahaan }}</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>
                                <form action="{{ route('distributor.update', $distributor->slug) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Perusahaan
                                                    <span class="required">*</span>
                                                </label>
                                                <input type="text" class="form-control" name="nama_perusahaan"
                                                    value="{{ old('nama_perusahaan', $distributor->nama_perusahaan) }}"
                                                    required placeholder="PT. KIMIA FARMA">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Pemilik Perusahaan</label>
                                                <input type="text" class="form-control" name="pemilik_perusahaan"
                                                    placeholder="FARM KIM"
                                                    value="{{ $distributor->pemilik_perusahaan }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Telepon Perusahaan</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $distributor->telepon_perusahaan }}"
                                                    name="telepon_perusahaan" placeholder="04xxxx">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Lokasi Perusahaan</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $distributor->lokasi_perusahaan }}"
                                                    name="lokasi_perusahaan" placeholder="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger light"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-warning">Ubah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- END MODAL EDIT DATA DISTRIBUTOR --}}

                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Perusahaan</th>
                        <th>Pemilik Perusahaan</th>
                        <th>Telepon Perusahaan</th>
                        <th>Lokasi Perusahaan</th>
                        <th>Akun</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    @if($errors->any())
        $(document).ready(function () {
            $('#error-message').addClass('show');
            $('#tambahDistributor').modal('show');
        });
    @endif
</script>
@endpush