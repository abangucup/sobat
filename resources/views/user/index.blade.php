@extends('layouts.app')

@section('title', 'User')

@section('header', 'Data User')

@section('content')

<div class="card">
    <div class="card-header">
        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambahUser"><i
                class="fa-regular fa-square-plus"></i> Tambah User</button>
    </div>

    @include('user.modal_tambah')

    <div class="card-body shadow-sm pb-0">
        <div class="table-responsive">
            <table class="display data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Instansi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->biodata->nama_lengkap }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->email }}</td>
                        <td><a href="https://wa.me/{{ $user->biodata->no_hp ?? '' }}" target="_blank"
                                class="btn btn-info btn-xs" type="button"><i class="fa-brands fa-whatsapp me-2"></i>{{
                                $user->biodata->no_hp }}</a>
                        </td>
                        <td>{{ $user->akunDistributor->distributor->nama_perusahaan ?? 'RSUD OTANAHA' }}</td>
                        <td>
                            <div class="d-flex">

                                <button data-bs-target="#ubahUser-{{ $user->id }}" data-bs-toggle="modal"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                    class="btn btn-warning shadow btn-xs sharp me-1"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                                <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                        class="btn btn-danger shadow btn-xs sharp">
                                        <i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- MODAL EDIT --}}
                    <div class="modal fade tampil-modal" id="ubahUser-{{ $user->id }}" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Ubah Data</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>
                                <form action="{{ route('user.update', $user->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Petugas
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" name="nama_lengkap"
                                                        value="{{ old('nama_lengkap', $user->biodata->nama_lengkap) }}"
                                                        placeholder="Nama Lengkap" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Jenis Kelamin
                                                        <span class="required">*</span>
                                                    </label>
                                                    <select name="jenis_kelamin" class="form-control" required>
                                                        <option value="{{ $user->biodata->jenis_kelamin }}" selected>{{
                                                            $user->biodata->jenis_kelamin == 'l' ? 'Laki - Laki' :
                                                            'Perempuan' }}</option>
                                                        <option value="" disabled>-- Jenis Kelamin --</option>
                                                        <option value="l">Laki - Laki</option>
                                                        <option value="p">Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Lahir
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" placeholder="2017-06-04"
                                                        id="mdate" name="tanggal_lahir"
                                                        value="{{ old('tanggal_lahir', $user->biodata->tanggal_lahir) }}"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Telepon Petugas
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" name="no_hp"
                                                        value="{{ old('no_hp', $user->biodata->no_hp) }}"
                                                        placeholder="6282xxxx" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Alamat
                                                        <span class="required"></span>
                                                    </label>
                                                    <input type="text" class="form-control" name="alamat"
                                                        value="{{ old('alamat', $user->biodata->alamat) }}"
                                                        placeholder="Otanaha">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @if (auth()->user()->role == 'gudang' && $user->role !== 'distributor')
                                                <div class="mb-3">
                                                    <label class="form-label">Level User
                                                        <span class="required">*</span>
                                                    </label>
                                                    <select name="role" class="form-control" required>
                                                        <option value="{{ $user->role }}" selected>{{
                                                            Str::ucfirst($user->role) }}</option>
                                                        <option value="" disabled>-- Level User --</option>
                                                        <option value="gudang">Gudang Farmasi</option>
                                                        <option value="ppk">PPK</option>
                                                        <option value="direktur">DIrektur</option>
                                                        <option value="depo">Depo</option>
                                                        <option value="poli">Poli</option>
                                                        <option value="pelayanan">Pelayanan</option>
                                                    </select>
                                                </div>
                                                @endif

                                                @if (auth()->user()->role == 'gudang' && $user->role == 'distributor')
                                                <div class="mb-3">
                                                    <label class="form-label">Level User
                                                        <span class="required">*</span>
                                                    </label>
                                                    <select name="role" class="form-control" required>
                                                        <option value="{{ $user->role }}" selected>{{
                                                            Str::ucfirst($user->role) }}</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Distributor
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $user->akunDistributor->distributor->nama_perusahaan }}"
                                                        disabled>
                                                </div>
                                                @endif

                                                <div class="mb-3">
                                                    <label class="form-label">Username
                                                        <span class="required">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" name="username"
                                                        value="{{ old('username', $user->username) }}"
                                                        placeholder="Username" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email
                                                        <span class="required"></span>
                                                    </label>
                                                    <input type="email" class="form-control" name="email"
                                                        value="{{ old('email', $user->email) }}" placeholder="Email">
                                                </div>
                                                <div>
                                                    <label class="text-label form-label" for="password">Password
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"> <i class="fa-solid fa-lock"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="password"
                                                            name="password" placeholder="Masukan Password">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger light"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-warning">Ubah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- END MODAL EDIT --}}

                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Instansi</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    @if($errors->any())
        $(document).ready(function () {
            $('#error-message').addClass('show');
            $('#tambahUser').modal('show');
        });
    @endif
</script>
@endpush