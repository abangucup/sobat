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
                        <th>Status Exp</th>
                        {{-- Box @ 100 Tablet --}}
                        <th>Satuan</th>
                        <th>Harga Beli</th>
                        <th>Stok</th>
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($obats as $dataObat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dataObat->obat->kode_obat }}</td>
                        <td>{{ $dataObat->obat->nama_obat }}</td>
                        <td>{{ $dataObat->obat->no_batch }}</td>
                        <td>{{ \Carbon\Carbon::parse($dataObat->obat->tanggal_kedaluwarsa)->isoFormat('LL') }}</td>
                        <td>
                            <span
                                class="badge badge-{{ $dataObat->obat->tanggal_kedaluwarsa < now()->copy()->addMonths(6) ? 'danger' : 'primary' }}">{{
                                $dataObat->obat->tanggal_kedaluwarsa < now()->
                                    copy()->addMonths(6) ? '< 6 Bulan | Expired' : '> 6 Bulan | Valid' }} </span>
                        </td>
                        <td>{{ $dataObat->obat->satuan. ' @ '.$dataObat->obat->kapasitas.' '.
                            $dataObat->obat->satuan_kapasitas }}</td>

                        @if (auth()->user()->role == 'distributor')
                        <td>{{ 'Rp. ' . number_format($dataObat->harga_beli, 0, ',',
                            '.') }}
                        </td>
                        <td>{{ $dataObat->stok .' '.$dataObat->obat->satuan }}</td>
                        <td>{{ 'Rp. ' . number_format($dataObat->harga_jual, 0, ',',
                            '.') }}
                        </td>
                        @else
                        <td>{{ 'Rp. ' . number_format($dataObat->harga_beli, 0, ',',
                            '.') . ' Per '.$dataObat->obat->satuan }}
                        </td>
                        <td>{{ $dataObat->jumlah_stok_isi . ' '.$dataObat->obat->satuan_kapasitas }}</td>
                        <td>{{ 'Rp. ' . number_format($dataObat->harga_jual, 0, ',',
                            '.') . ' Per '.$dataObat->obat->satuan_kapasitas }}
                        </td>
                        @endif

                        <td>
                            <div class="d-flex">
                                <a href="{{ route('obat.show', $dataObat->obat->slug) }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Detail"
                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                        class="fa-solid fa-info"></i></a>

                                <button data-bs-toggle="modal" data-bs-target="#editObat-{{ $dataObat->obat->slug }}"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                    class="btn btn-warning shadow btn-xs sharp me-1"><i
                                        class="fa-solid fa-pen-to-square"></i></button>

                                @if ($user->role == 'distributor' || $user->role == 'gudang')
                                <form action="{{ route('obat.destroy', $dataObat->obat->slug) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                        class="btn btn-danger shadow btn-xs sharp">
                                        <i class="fa fa-trash"></i></button>
                                </form>
                                @endif

                            </div>
                        </td>
                    </tr>

                    {{-- Modal Edit TAPI UNTUK LEVEL DISTRIBUTOR--}}
                    @if ($user->role == 'distributor')
                    <div class="modal fade tampil-modal" id="editObat-{{ $dataObat->obat->slug }}" tabindex="-1"
                        role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Ubah Data</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>
                                <form action="{{ route('obat.update', $dataObat->obat->slug) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                @if (auth()->user()->role == 'gudang')
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Distributor
                                                        <span class="required">*</span>
                                                    </label>
                                                    <select name="distributor_id" class="form-select">
                                                        <option value="{{ $dataObat->distributor_id }}" selected>{{
                                                            $dataObat->distributor->nama_perusahaan }}</option>
                                                        <option value="" disabled>-- Pilih Distributor --
                                                        </option>
                                                        @foreach ($distributors as $distributor)
                                                        <option value="{{ $distributor->id }}">{{
                                                            $distributor->nama_perusahaan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @endif
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Obat / BMHP
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" name="nama_obat"
                                                        value="{{ old('nama_obat', $dataObat->obat->nama_obat) }}"
                                                        required placeholder="Paracetamol">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nomor Batch
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" name="no_batch"
                                                        value="{{ old('no_batch', $dataObat->obat->no_batch) }}"
                                                        placeholder="F6009">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Kategori
                                                        <span class="required">*</span>
                                                    </label>
                                                    <select name="satuan" class="form-select">
                                                        <option value="{{ $dataObat->obat->satuan }}" selected>{{
                                                            $dataObat->obat->satuan }}
                                                        </option>
                                                        <option value="" disabled>-- Pilih Kategori --</option>
                                                        <option value="Karton">Karton</option>
                                                        <option value="Dos">Dos</option>
                                                        <option value="Pak">Pak</option>
                                                        <option value="Strip">Strip</option>
                                                        <option value="Bal">Bal</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Exp
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="date" name="tanggal_kedaluwarsa"
                                                        value="{{ old('tanggal_kedaluwarsa', $dataObat->obat->tanggal_kedaluwarsa) }}"
                                                        class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Stok Obat
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="number" class="form-control" name="stok"
                                                        value="{{ old('stok', $dataObat->stok) }}" placeholder="20">
                                                    <sub>Catatan: Stok obat berdasarkan kategori</sub>
                                                </div>


                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Harga Beli
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="harga" name="harga_beli"
                                                        value="{{ old('harga_beli', 'Rp ' . number_format($dataObat->harga_beli, 0, ',', '.')) }}"
                                                        placeholder="20">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Pembelian
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="date" name="tanggal_beli"
                                                        value="{{ old('tanggal_beli', $dataObat->tanggal_beli) }}"
                                                        class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Harga Jual
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="harga" name="harga_jual"
                                                        value="{{ old('harga_jual', 'Rp ' . number_format($dataObat->harga_jual, 0, ',', '.')) }}"
                                                        placeholder="20">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Isi</label>
                                                    <input type="number" name="kapasitas"
                                                        value="{{ old('kapasitas', $dataObat->obat->kapasitas) }}"
                                                        class="form-control" placeholder="20">
                                                    <sub>Catatan: Isi merupakan banyaknya yang ada didalam
                                                        kategori.</sub>

                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Satuan</label>
                                                    <select name="satuan_kapasitas" class="form-select">
                                                        <option value="{{ $dataObat->obat->satuan_kapasitas }}"
                                                            selected>{{
                                                            $dataObat->obat->satuan_kapasitas }}
                                                        </option>
                                                        <option value="" disabled>-- Pilih Satuan --
                                                        </option>
                                                        <option value="Tablet (tab)">Tablet (tab)</option>
                                                        <option value="Kapsul (kap / cps)">Kapsul (kap / cps)</option>
                                                        <option value="Vial">Vial</option>
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
                                                    <sub>Catatan: Satuan dari isi berdasarkan kategori</sub>

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
                    {{-- END MODAL EDIT LEVEL DISTRIBUTOR --}}

                    @else
                    {{-- MODAL EDIT SELAIN ATAU BUKAN LEVEL DISTRIBUTOR --}}
                    <div class="modal fade tampil-modal" id="editObat-{{ $dataObat->obat->slug }}" tabindex="-1"
                        role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Ubah Data</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>
                                <form action="{{ route('obat.ubahHarga', $dataObat->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Obat / BMHP
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" name="nama_obat"
                                                        value="{{ $dataObat->obat->nama_obat }}" disabled
                                                        placeholder="Paracetamol">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nomor Batch
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" name="no_batch" disabled
                                                        value="{{$dataObat->obat->no_batch }}" placeholder="F6009">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Kategori
                                                        <span class="required">*</span>
                                                    </label>
                                                    <select name="satuan" class="form-select" disabled>
                                                        <option value="{{ $dataObat->obat->satuan }}" selected disabled>
                                                            {{
                                                            $dataObat->obat->satuan }}
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Exp
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="date" name="tanggal_kedaluwarsa" disabled
                                                        value="{{ $dataObat->obat->tanggal_kedaluwarsa }}"
                                                        class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Stok
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="number" class="form-control" name="stok" disabled
                                                        value="{{ $dataObat->stok }}" placeholder="20">
                                                    <sub>Catatan: Stok obat berdasarkan kategori</sub>

                                                </div>


                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Harga Beli
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="harga" name="harga_beli"
                                                        disabled
                                                        value="{{ 'Rp ' . number_format($dataObat->harga_beli, 0, ',', '.') }}"
                                                        placeholder="20">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Pembelian
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="date" name="tanggal_beli" disabled
                                                        value="{{ $dataObat->tanggal_beli }}" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Harga Jual
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="harga" name="harga_jual"
                                                        value="{{ old('harga_jual', 'Rp ' . number_format($dataObat->harga_jual, 0, ',', '.')) }}"
                                                        placeholder="20">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Isi</label>
                                                    <input type="number" name="kapasitas" disabled
                                                        value="{{ $dataObat->obat->kapasitas }}" class="form-control"
                                                        placeholder="20">
                                                    <sub>Catatan: Isi merupakan banyaknya yang ada didalam
                                                        kategori.</sub>

                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Satuan</label>
                                                    <select name="satuan_kapasitas" class="form-select" disabled>
                                                        <option value="{{ $dataObat->satuan_kapasitas }}" selected
                                                            disabled>{{
                                                            $dataObat->obat->satuan_kapasitas }}
                                                        </option>
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
                    {{-- END MODAL EDIT BUKAN LEVEL DISTRIBUTOR --}}
                    @endif
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