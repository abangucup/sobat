<div class="modal fade tampil-modal" id="ubahPermintaan-{{ $permintaan->id }}" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Ubah Data</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form action="{{ route('permintaan.update', $permintaan->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Obat
                                    <span class="required">*</span>
                                </label>
                                <select name="obat" class="form-control" required>
                                    <option value="{{ $permintaan->stok_obat_id }}" selected>{{
                                        $permintaan->stokObat->obat->nama_obat }} -
                                        {{ $permintaan->stokObat->obat->satuan }} @ {{
                                        $permintaan->stokObat->obat->kapasitas }} {{
                                        $permintaan->stokObat->obat->satuan_kapasitas }} | Exp:
                                        {{
                                        \Carbon\Carbon::parse($permintaan->stokObat->obat->tanggal_kedaluwarsa)->isoFormat('LL')
                                        }} </option>
                                    <option value="" disabled>-- Pilih Obat -- </option>
                                    @foreach ($dataObats as $dataObat)
                                    @php
                                    $obat = $dataObat->obat;
                                    $harga_jual = 'Rp '.number_format($dataObat->harga_jual, 0, ',', '.');
                                    @endphp
                                    <option value="{{ $dataObat->id }}">{{ $obat->nama_obat }} - Stok {{ $obat->satuan
                                        }} @ {{
                                        $obat->kapasitas }} {{ $obat->satuan_kapasitas }} |
                                        Exp: {{
                                        \Carbon\Carbon::parse($dataObat->obat->tanggal_kedaluwarsa)->isoFormat('LL') }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Banyak Permintaan
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control" name="banyak" placeholder="100"
                                    value="{{ old('banyak', $permintaan->banyak) }}" required>
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
                    <button type="submit" class="btn btn-warning">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>