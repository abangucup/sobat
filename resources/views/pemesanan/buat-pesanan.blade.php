@extends('layouts.app')

@section('title', 'Pemesanan Obat')

@section('header', 'Buat Pesanan')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Form Pemesanan</h4>
    </div>
    <div class="card-body shadow-sm pb-0">
        <form action="{{ route('pemesanan-obat.store') }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="row">
                    {{-- Data Distributor --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Pilih Obat
                                <span class="required">*</span>
                            </label>
                            <select name="obats[]" class="form-select select2" multiple >
                                @foreach ($stokObats as $stok)
                                <option value="{{ $stok->obat->id }}">{{ $stok->obat->nama_obat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pemilik Perusahaan</label>
                            <input type="text" class="form-control" name="pemilik_perusahaan" placeholder="FARM KIM">
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
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
@endpush

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.select2').select2();
});
</script>
@endpush