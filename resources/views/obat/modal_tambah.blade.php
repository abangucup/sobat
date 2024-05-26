<div class="modal fade tampil-modal" id="tambahObat" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Data</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form action="{{ route('obat.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if (auth()->user()->role == 'gudang')
                            <div class="mb-3">
                                <label class="form-label">Nama Distributor
                                    <span class="required">*</span>
                                </label>
                                <select name="distributor_id" class="form-select">
                                    <option value="" selected disabled>-- Pilih Distributor --</option>
                                    @foreach ($distributors as $distributor)
                                        <option value="{{ $distributor->id }}">{{ $distributor->nama_perusahaan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label">Nama Obat
                                    <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" name="nama_obat" value="{{ old('nama_obat') }}"
                                    required placeholder="Paracetamol">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nomor Batch
                                    <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" name="no_batch" value="{{ old('no_batch') }}"
                                    placeholder="F6009">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Satuan
                                    <span class="required">*</span>
                                </label>
                                <select name="satuan" class="form-select">
                                    <option value="" selected disabled>-- Pilih Satuan --</option>
                                    <option value="Kotak (box)">Kotak (box)</option>
                                    <option value="Botol Besar (bottle)">Botol Besar (bottle)</option>
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
                                <input type="date" name="tanggal_kedaluwarsa" value="{{ old('tanggal_kedaluwarsa') }}"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stok Obat
                                    <span class="required">*</span>
                                </label>
                                <input type="number" class="form-control" name="stok" value="{{ old('stok') }}"
                                    placeholder="20">
                            </div>
                            

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Harga Beli
                                    <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" id="harga" name="harga_beli"
                                    value="{{ old('harga_beli') }}" placeholder="20">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Pembelian
                                    <span class="required">*</span>
                                </label>
                                <input type="date" name="tanggal_beli" value="{{ old('tanggal_beli') }}"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga Jual
                                    <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" id="harga" name="harga_jual"
                                    value="{{ old('harga_jual') }}" placeholder="20">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kapasitas</label>
                                <input type="number" name="kapasitas" value="{{ old('kapasitas') }}"
                                    class="form-control" placeholder="20">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Satuan Kapasitas</label>
                                <select name="satuan_kapasitas" class="form-select">
                                    <option value="" selected disabled>-- Pilih Satuan Untuk Kapasitas --</option>
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
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>