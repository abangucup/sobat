@extends('layouts.app')

@section('title', 'Obat')

@section('header', 'Data Obat')

@section('content')

<div class="card">

    @if (auth()->user()->role == 'distributor')
    <div class="card-header">
        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambahObat"><i
                class="fa-regular fa-square-plus"></i> Tambah Obat</button>
    </div>
    @include('obat.modal_tambah')
    @endif

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
                        <th>Harga Beli</th>
                        <th>Stok</th>
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($obats as $obat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $obat->kode_obat }}</td>
                        <td>{{ $obat->nama_obat }}</td>
                        <td>{{ $obat->no_batch }}</td>
                        <td>{{ \Carbon\Carbon::parse($obat->tanggal_kedaluwarsa)->isoFormat('LL') }}</td>
                        <td>{{ $obat->satuan. ' @ '.$obat->kapasitas.' '. $obat->satuan_kapasitas }}</td>
                        <td>{{ 'Rp. ' . number_format($obat->stokObats->first()->harga_beli, 0, ',',
                            '.') }}
                        </td>
                        <td>{{ $obat->stokObats->first()->stok }}</td>
                        <td>{{ 'Rp. ' . number_format($obat->stokObats->first()->harga_jual, 0, ',',
                            '.') }}
                        </td>

                        {{-- @foreach ($obat->stokObats as $stokObat)
                        <td>{{ 'Rp. ' . number_format($stokObat->harga_beli, 0, ',', '.') }}</td>
                        <td>{{ $stokObat->stok }}</td>
                        <td>{{ 'Rp. ' . number_format($stokObat->harga_jual, 0, ',', '.') }}</td>
                        @endforeach --}}
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('obat.show', $obat->slug) }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Detail"
                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                        class="fa-solid fa-info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#editObat-{{ $obat->slug }}"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                    class="btn btn-warning shadow btn-xs sharp me-1"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
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

                    {{-- Modal Edit --}}
                    <div class="modal fade tampil-modal" id="editObat-{{ $obat->slug }}" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Ubah Data</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>
                                <form action="{{ route('obat.update', $obat->slug) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Obat
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" name="nama_obat"
                                                        value="{{ old('nama_obat', $obat->nama_obat) }}" required
                                                        placeholder="Paracetamol">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nomor Batch
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" name="no_batch"
                                                        value="{{ old('no_batch', $obat->no_batch) }}"
                                                        placeholder="F6009">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Satuan
                                                        <span class="required">*</span>
                                                    </label>
                                                    <select name="satuan" class="form-select">
                                                        <option value="{{ $obat->satuan }}" selected>{{ $obat->satuan }}</option>
                                                        <option value="" disabled>-- Pilih Satuan --</option>
                                                        <option value="Kotak (box)">Kotak (box)</option>
                                                        <option value="Botol Besar (bottle)">Botol Besar (bottle)
                                                        </option>
                                                        <option value="Kemasan (pack)">Kemasan (pack)</option>
                                                        <option value="Karton (carton)">Karton (carton)</option>
                                                        <option value="Jerigen (jerry can)">Jerigen (jerry can)</option>
                                                        <option value="Drum">Drum</option>
                                                        <option value="Bal (bale)">Bal (bale)</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Exp
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="date" name="tanggal_kedaluwarsa"
                                                        value="{{ old('tanggal_kedaluwarsa', $obat->tanggal_kedaluwarsa) }}"
                                                        class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Stok Obat
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="number" class="form-control" name="stok"
                                                        value="{{ old('stok', $obat->stokObats->first()->stok) }}"
                                                        placeholder="20">
                                                </div>


                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Harga Beli
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="harga" name="harga_beli"
                                                        value="{{ old('harga_beli', 'Rp ' . number_format($obat->stokObats->first()->harga_beli, 0, ',', '.')) }}"
                                                        placeholder="20">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Pembelian
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="date" name="tanggal_beli"
                                                        value="{{ old('tanggal_beli', $obat->stokObats->first()->tanggal_beli) }}"
                                                        class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Harga Jual
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="harga" name="harga_jual"
                                                        value="{{ old('harga_jual', 'Rp ' . number_format($obat->stokObats->first()->harga_jual, 0, ',', '.')) }}"
                                                        placeholder="20">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Kapasitas</label>
                                                    <input type="number" name="kapasitas"
                                                        value="{{ old('kapasitas', $obat->kapasitas) }}"
                                                        class="form-control" placeholder="20">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Satuan Kapasitas</label>
                                                    <select name="satuan_kapasitas" class="form-select">
                                                        <option value="{{ $obat->satuan_kapasitas }}" selected>{{ $obat->satuan_kapasitas }}
                                                        </option>
                                                        <option value="" disabled>-- Pilih Satuan Untuk Kapasitas --
                                                        </option>
                                                        <option value="Tablet (tab)">Tablet (tab)</option>
                                                        <option value="Kapsul (kap / cps)">Kapsul (kap / cps)</option>
                                                        <option value="Kaplet">Kaplet</option>
                                                        <option value="Sirup">Sirup</option>
                                                        <option value="Krim">Krim</option>
                                                        <option value="Salep">Salep</option>
                                                        <option value="Serbuk">Serbuk</option>
                                                        <option value="Injeksi">Injeksi</option>
                                                        <option value="Tetes">Tetes</option>
                                                        <option value="Supositoria">Supositoria</option>
                                                        <option value="Aerosol">Aerosol</option>
                                                        <option value="Suspensi">Suspensi</option>
                                                        <option value="Larutan">Larutan</option>
                                                        <option value="Ampul">Ampul</option>
                                                        <option value="Botol">Botol</option>
                                                        <option value="Tube">Tube</option>
                                                        <option value="Strip">Strip</option>
                                                        <option value="Sachet">Sachet</option>
                                                    </select>
                                                </div>
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
                    {{-- End Modal Edit --}}

                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>No. Batch</th>
                        <th>Exp Date</th>
                        {{-- Box @ 100 Tablet --}}
                        <th>Satuan</th>
                        <th>Harga Beli</th>
                        <th>Stok</th>
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

{{-- @push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
@endpush

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $('#tambahObat').on('shown.bs.modal', function () {
        $('#select2').select2();
    });
</script>
@endpush --}}