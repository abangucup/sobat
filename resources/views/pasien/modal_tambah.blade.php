<div class="modal fade tampil-modal" id="tambahPasien" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Data</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form action="{{ route('pasien.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Nama Pasien
                                    <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" name="nama_lengkap"
                                    value="{{ old('nama_lengkap') }}" required placeholder="Windy Karim">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No HP
                                    <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp') }}" required
                                    placeholder="08xxxx">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin
                                    <span class="required">*</span>
                                </label>
                                <select name="jenis_kelamin" class="form-control defaul-select">
                                    <option value="" selected disabled>-- Jenis Kelamin --</option>
                                    <option value="l">Laki-Laki</option>
                                    <option value="p">Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir
                                    <span class="required">*</span>
                                </label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat
                                    <span class="required">*</span>
                                </label>
                                <textarea name="alamat" class="form-control" rows="5"
                                    placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
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