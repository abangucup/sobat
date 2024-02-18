<div class="modal fade tampil-modal" id="tambahDistributor" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Data</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form action="{{ route('distributor.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        {{-- Data Distributor --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Perusahaan
                                    <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" name="nama_perusahaan"
                                    value="{{ old('nama_perusahaan') }}" required placeholder="PT. KIMIA FARMA">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pemilik Perusahaan</label>
                                <input type="text" class="form-control" name="pemilik_perusahaan"
                                    placeholder="FARM KIM">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Telepon Perusahaan</label>
                                <input type="text" class="form-control" name="telepon_perusahaan" placeholder="04xxxx">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lokasi Perusahaan</label>
                                <input type="text" class="form-control" name="lokasi_perusahaan" placeholder="text">
                            </div>
                        </div>
                        {{-- DATA AKUN --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Petugas
                                    <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" name="nama_lengkap"
                                    value="{{ old('nama_lengkap') }}" placeholder="Nama Lengkap">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Telepon Petugas
                                    <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" required name="no_hp" value="{{ old('no_hp') }}"
                                    placeholder="082xxxx">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Username
                                    <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" required name="username"
                                    value="{{ old('username') }}" placeholder="Username">
                            </div>
                            <div class="mb-3">
                                <label class="text-label form-label" for="password">Password
                                    <span class="required">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"> <i class="fa-solid fa-lock"></i> </span>
                                    <input type="text" class="form-control" id="password" name="password"
                                        placeholder="Masukan Password" required>
                                </div>
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