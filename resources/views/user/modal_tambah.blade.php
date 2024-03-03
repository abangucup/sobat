<div class="modal fade tampil-modal" id="tambahUser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Data</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form action="{{ route('user.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Petugas
                                    <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" name="nama_lengkap"
                                    value="{{ old('nama_lengkap') }}" placeholder="Nama Lengkap" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin
                                    <span class="required">*</span>
                                </label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="" selected disabled>-- Jenis Kelamin --</option>
                                    <option value="l">Laki - Laki</option>
                                    <option value="p">Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir
                                    <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" placeholder="2017-06-04" id="mdate"
                                    name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Telepon Petugas
                                    <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp') }}"
                                    placeholder="6282xxxx" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat
                                    <span class="required"></span>
                                </label>
                                <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}"
                                    placeholder="Otanaha">
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if (auth()->user()->role == 'gudang')
                            <div class="mb-3">
                                <label class="form-label">Level User
                                    <span class="required">*</span>
                                </label>
                                <select name="role" class="form-control" required>
                                    <option value="" selected disabled>-- Level User --</option>
                                    <option value="gudang">Gudang Farmasi</option>
                                    <option value="ppk">PPK</option>
                                    <option value="direktur">DIrektur</option>
                                    <option value="depo">Depo</option>
                                    <option value="poli">Poli</option>
                                    <option value="pelayanan">Pelayanan</option>
                                </select>
                            </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Username
                                    <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" name="username" value="{{ old('username') }}"
                                    placeholder="Username" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email
                                    <span class="required"></span>
                                </label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                    placeholder="Email">
                            </div>
                            <div>
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