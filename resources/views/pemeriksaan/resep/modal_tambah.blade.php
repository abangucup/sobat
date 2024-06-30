<div class="modal fade tampil-modal" id="tambahResep" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Data</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form action="{{ route('pemeriksaan.storeResep', $pemeriksaan->id) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">REAGEN / BHP / OBAT
                                    <span class="required">*</span>
                                </label>
                                <select name="stok_obat_id" class="form-control" required>
                                    <option value="" selected disabled>-- Pilih Obat Yang Dipakai --</option>
                                    @foreach ($dataObats as $dataObat)
                                    @php
                                    $obat = $dataObat->obat;
                                    $harga_jual = 'Rp '.number_format($dataObat->harga_jual, 0, ',', '.');
                                    @endphp
                                    <option value="{{ $dataObat->id }}">{{ $obat->nama_obat }} | Stok {{
                                        $dataObat->jumlah_stok_isi . ' '.$dataObat->obat->satuan_kapasitas }} | Harga {{ $harga_jual }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Banyak Pemakaian
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control" name="jumlah" value="{{ old('jumlah') }}"
                                    placeholder="1" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keterangan
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea name="keterangan" class="form-control" rows="3"
                                    placeholder="3x Sehari"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>