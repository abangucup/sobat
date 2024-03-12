@extends('layouts.app')

@section('title', 'Pemesanan Obat')

@section('header', 'Daftar Pemesanan')

@section('content')

<div class="card">
    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="display data-table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>PEMESAN</th>
                        <th>REAGEN/BHP/OBAT</th>
                        <th>JUMLAH</th>
                        <th>SATUAN</th>
                        <th>TANGGAL</th>
                        <th>LIHAT SURAT</th>
                        <th>STATUS PENGIRIMAN</th>
                        <th>STATUS PESANAN</th>
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
                            @if ($pesanan->status_pengiriman == 'dikirim')
                            <button class="btn btn-success btn-xs"><i class="fa-solid fa-truck me-2"></i>Dikirimkan
                            </button>
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
                            @else
                            <button class="btn btn-outline-danger btn-xs" data-bs-toggle="modal"
                                data-bs-target="#pengiriman-{{ $pesanan->id }}">Update Status
                            </button>
                            {{-- MODAL UPDATE PENGIRIMAN --}}
                            <div class="modal fade" id="pengiriman-{{ $pesanan->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('verif.pengiriman', $pesanan->id) }}" method="post">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Verifikasi Pengiriman
                                                    Pesanan
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Pilih Status Pengiriman
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select name="status_pengiriman" class="form-select default-select"
                                                        required>
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
                            @endif
                        </td>
                        <td>
                            @if (!$pesanan->verif)
                            <button class="btn btn-xs btn-warning">Proses</button>
                            @else
                            <button class="btn btn-xs btn-success" data-bs-toggle="modal"
                                data-bs-target="#lihatStatusPesanan-{{ $pesanan->verif->id }}"><i
                                    class="fa-regular fa-eye me-2"></i>Pesanan Selesai
                            </button>
                            {{-- MODAL LIHAT HASIL VERIF --}}
                            <div class="modal fade" id="lihatStatusPesanan-{{ Str::slug($pesanan->verif->id) }}"
                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hasil Verif
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mt-3">
                                                <label>Tambahkan Catatan</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Str::ucfirst($pesanan->verif->kondisi_pesanan) }}">
                                            </div>
                                            <div class="form-group mt-3">
                                                <label>Tambahkan Catatan</label>
                                                <textarea class="form-control" rows="3"
                                                    placeholder="Jumlah sudah sesuai yang diantarkan"
                                                    disabled>{{ $pesanan->verif->catatan ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- END MODAL LIHAT HASIL VERIF --}}

                            @endif
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection