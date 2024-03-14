@extends('layouts.app')

@section('title', 'Obat Expired')

@section('header', 'Data Obat Expired')

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
                        <th>Harga Beli</th>
                        <th>Stok</th>
                        <th>Bidang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($obatExpireds as $dataObat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dataObat->obat->kode_obat }}</td>
                        <td>{{ $dataObat->obat->nama_obat }}</td>
                        <td>{{ $dataObat->obat->no_batch }}</td>
                        <td>{{ \Carbon\Carbon::parse($dataObat->obat->tanggal_kedaluwarsa)->isoFormat('LL') }}</td>
                        <td>{{ $dataObat->obat->satuan. ' @ '.$dataObat->obat->kapasitas.' '.
                            $dataObat->obat->satuan_kapasitas }}</td>
                        <td>{{ 'Rp. ' . number_format($dataObat->harga_beli, 0, ',', '.') }}</td>
                        <td>{{ $dataObat->stok }}</td>
                        <td>{{ Str::ucfirst($dataObat->lokasi) }}</td>
                        <td>
                            @if ($dataObat->expired)
                            <button class="btn btn-xs btn-outline-success shadow-l" data-bs-toggle="modal"
                                data-bs-target="#pengembalian-{{ $dataObat->id }}">Lihat Status</button>
                            @else
                            <button class="btn btn-xs btn-outline-primary shadow-l" data-bs-toggle="modal"
                                data-bs-target="#pengembalian-{{ $dataObat->id }}">Ajukan Pengembalian</button>
                            @endif

                        </td>
                    </tr>

                    {{-- MODAL PENGEMBALIAN --}}
                    <div class="modal fade tampil-modal" id="pengembalian-{{ $dataObat->id }}" tabindex="-1"
                        role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Ajukan Pengembalian</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>
                                <form action="{{ route('expired.pengajuan', $dataObat->id) }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Tambahkan Catatan</label>
                                            <textarea name="catatan" class="form-control" rows="4"
                                                placeholder="Tambahkan catatan jika perlu"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger light"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Ajukan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- END MODAL --}}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection