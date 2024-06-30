@extends('layouts.app')

@section('title', 'Pemesanan Obat')

@section('header', 'Buat Pesanan')

@section('content')

<form action="{{ route('pemesanan.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            <h4>Form Pemesanan</h4>
            <button class="text-end btn btn-primary"><i class="fa-solid fa-paper-plane me-2"></i>Simpan Konsep</button>
        </div>
        <div class="card-body mb-4">
            <div class="row">
                <div class="col-md-5">
                    <div class="mt-3">
                        <label class="form-label">Pilih Obat
                            <span class="required">*</span>
                        </label>
                        <select name="obat[]" class="form-control select2" required>
                            @foreach ($stokObats->where('lokasi', 'distributor') as $stok)
                            @php
                            $obat = $stok->obat;
                            $harga_jual = 'Rp '.number_format($stok->harga_jual, 0, ',', '.');
                            @endphp
                            {{-- <option value="{{ $obat->id }}">{{ $obat->nama_obat }} - {{ $obat->satuan }} @ {{
                                $obat->kapasitas }} {{ $obat->satuan_kapasitas }} | Stok {{
                                $stok->stok }} | Harga {{ $harga_jual }} </option> --}}
                                <option value="{{ $obat->id }}">{{ $obat->nama_obat }} | Stok {{
                                $stok->stok .' '. $obat->satuan}} | Isi {{ $obat->kapasitas.' '.$obat->satuan_kapasitas }} | Harga {{ $harga_jual }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3 mb-3">
                        <label class="form-label">Banyak
                            <span class="required">*</span>
                        </label>
                        <input type="number" class="form-control" name="banyak[]" placeholder="100" required>
                    </div>
                    <div id="formObatStok"></div>
                    <button type="button" id="tombolTambahForm" class="btn btn-secondary btn-xs">Tambahkan Form</button>
                </div>
                <div class="col-md-7">
                    <div class="mt-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" rows="3" class="form-control"
                            placeholder="Masukan keterangan pemesanan obat"></textarea>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <div id="preview"></div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('style')
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />

@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // $('.select2').select2();
        $(".select2").select2({
            theme: "bootstrap-5",
        });
        
        $('#tombolTambahForm').click(function() {
            $('#formObatStok').append(`
                <div class="formObatItem">
                    <div>
                        <label class="form-label">Pilih Obat
                            <span class="required">*</span>
                        </label>
                        <select name="obat[]" class="form-control select2" required>
                            @foreach ($stokObats->where('lokasi', 'distributor') as $stok)
                            @php
                            $obat = $stok->obat;
                            $harga_jual = 'Rp '.number_format($stok->harga_jual, 0, ',', '.');
                            @endphp
                            <option value="{{ $obat->id }}">{{ $obat->nama_obat }} | Stok {{
                                $stok->stok .' '. $obat->satuan}} | Isi {{ $obat->kapasitas.' '.$obat->satuan_kapasitas }} | Harga {{ $harga_jual }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3 mb-3">
                        <label class="form-label">Banyak
                            <span class="required">*</span>
                        </label>
                        <input type="number" class="form-control" name="banyak[]" placeholder="100" required>
                    </div>
                    <button type="button" class="mb-3 btn btn-danger btn-xs tombolHapusForm">Hapus Form</button>
                </div>
            `);

            // Re-inisialisasi Select2 untuk Formulir Baru
            $(".select2").select2({
                theme: "bootstrap-5",
            });
        });

        // Menambahkan event handler untuk tombol hapus
        $('#formObatStok').on('click', '.tombolHapusForm', function() {
            $(this).closest('.formObatItem').remove();
        });
    });

    const inputDokumen = document.getElementById('dokumenInput');
    
    // Ambil elemen div untuk menampilkan preview
    const previewDiv = document.getElementById('preview');

    // Tambahkan event listener untuk peristiwa ketika dokumen dipilih
    inputDokumen.addEventListener('change', function() {
        // Pastikan ada dokumen yang dipilih
        if (this.files && this.files[0]) {
            // Ambil file yang dipilih
            const dokumen = this.files[0];

            // Buat URL objek lokal untuk file
            const fileURL = URL.createObjectURL(dokumen);

            // Tampilkan preview dokumen dalam elemen div
            if (dokumen.type === 'application/pdf') {
                // Jika dokumen adalah PDF, tampilkan menggunakan elemen iframe
                previewDiv.innerHTML = `<iframe src="${fileURL}" width="100%" height="700px"></iframe>`;
            } else if (dokumen.type === 'application/msword' || dokumen.type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                // Jika dokumen adalah Word (doc atau docx), tampilkan pesan
                previewDiv.textContent = `Dokumen Word: ${dokumen.name}`;
            } else if (dokumen.type.includes('image/')) {
                // Jika dokumen adalah gambar, tampilkan menggunakan elemen img
                previewDiv.innerHTML = `<img src="${fileURL}" alt="Preview Gambar" style="max-width: 100%; max-height: 500px;">`;
            } else {
                // Jika jenis dokumen tidak dikenali, tampilkan pesan
                previewDiv.textContent = `Dokumen tidak dapat ditampilkan: ${dokumen.name}`;
            }
        }
    });
</script>
@endpush