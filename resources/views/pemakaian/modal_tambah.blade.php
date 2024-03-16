<div class="modal fade tampil-modal" id="tambahPemakaian" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Data</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form action="{{ route('pemakaian.store') }}" method="post">
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
                                    <option value="{{ $dataObat->id }}">{{ $obat->nama_obat }} - {{ $obat->satuan }} @
                                        {{
                                        $obat->kapasitas }} {{ $obat->satuan_kapasitas }} | Stok {{
                                        $dataObat->stok }} | Harga {{ $harga_jual }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Pemakaian
                                    <span class="required">*</span>
                                </label>
                                <input type="date" name="tanggal_pemakaian" value="{{ old('tanggal_pemakaian') }}"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Banyak Pemakaian
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control" name="banyak" value="{{ old('banyak') }}" placeholder="100" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Catatan</label>
                                <textarea name="catatan" class="form-control" rows="3"
                                    placeholder="Tambahkan catatan jika perlu"></textarea>
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