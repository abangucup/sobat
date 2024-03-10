@extends('layouts.app')

@section('title', 'Pemesanan Obat')

@section('header', 'Daftar Pemesanan')

@section('content')

<div class="card">
    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="display  data-table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>PEMESAN</th>
                        <th>REAGEN/BHP/OBAT</th>
                        <th>JUMLAH</th>
                        <th>SATUAN</th>
                        <th>TANGGAL</th>
                        <th>LIHAT SURAT</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesanans as $pesanan)
                    @php
                    $surat = null;
                    foreach ($pesanan->pemesanan->surats as $surat) {
                    $surat = $surat;
                    }
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pesanan->pemesanan->user->biodata->nama_lengkap }}</td>
                        <td>{{ $pesanan->obat->nama_obat }}</td>
                        <td>{{ $pesanan->jumlah }}</td>
                        <td>{{ $pesanan->obat->satuan . ' @ ' . $pesanan->obat->kapasitas . ' ' .
                            $pesanan->obat->satuan_kapasitas}}</td>
                        <td>{{ \Carbon\Carbon::parse($pesanan->pemesanan->created_at)->isoFormat('LL') }}</td>
                        <td>
                            <button class="btn btn-info btn-xs" type="button" data-bs-toggle="modal"
                                data-bs-target="#surat-{{ Str::slug($surat->nomor_surat) }}"><i
                                    class="fa-solid fa-file-pdf me-2"></i>PREVIEW</button>
                        </td>
                        <td>
                            @if ($pesanan->status_pengiriman == 'dikirimkan')
                            <button class="btn btn-success btn-xs disabled" disabled>Pesanan Sedang Dikirimkan</button>
                            @else
                            <button
                                class="btn btn-outline-{{ $pesanan->status_pengiriman == 'dikirimkan' ? 'success' : 'danger' }} btn-xs"
                                data-bs-toggle="modal" data-bs-target="#pengiriman-{{ $pesanan->id }}">Update
                                Status</button>
                            @endif

                        </td>
                    </tr>

                    {{-- MODAL LIAT SURAT --}}
                    <div class="modal fade" id="surat-{{ Str::slug($surat->nomor_surat) }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Surat Pemesanan Obat {{
                                        $pesanan->obat->distributor->nama_perusahaan
                                        }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <iframe
                                        src="{{ route('surat.status', ['pemesanan_id' => $pesanan->pemesanan_id, 'distributor' => $pesanan->obat->distributor->nama_perusahaan]) }}"
                                        width="100%" height="100%"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- END MODAL LIHAT SURAT --}}

                    {{-- MODAL UPDATE PENGIRIMAN --}}
                    <div class="modal fade" id="pengiriman-{{ $pesanan->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('verif.pengiriman', $pesanan->id) }}" method="post">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Verifikasi Pengiriman Pesanan
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Pilih Status Pengiriman
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="status_pengiriman" class="form-select default-select" required>
                                                <option value="" selected disabled>-- Pilih Status Pengiriman --
                                                </option>
                                                <option value="dikirim">Dikirim</option>
                                                <option value="dibatalkan">Dibatalkan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-outline-danger" data-bs-dismiss="modal"
                                            type="button">Close</button>
                                        <button class="btn btn-outline-primary" type="submit">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- END MODAL UPDATE PENGIRIMAN --}}

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection