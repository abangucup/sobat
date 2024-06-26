<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailPesananController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\ExpiredController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PemakaianObatController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\TebusObatController;
use App\Http\Controllers\UserController;
use App\Models\AkunDistributor;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::group(['middleware' => 'guest', 'prefix' => 'auth'], function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {

    // SEMUA LEVEL YANG SUDAH LOGIN

    Route::get('dashboard', DashboardController::class)->name('dashboard');

    // Route::resource('obat', ObatController::class)->only(['index', 'show']);
    // Route::resource('obat', ObatController::class)->only(['store', 'update', 'destroy', 'edit']);
    Route::resource('obat', ObatController::class);


    Route::put('obat/stok-obat/{id}', [ObatController::class, 'ubahHarga'])->name('obat.ubahHarga');
    Route::resource('user', UserController::class);
    Route::resource('akun-distributor', AkunDistributor::class);

    Route::get('expired', [ExpiredController::class, 'index'])->name('expired.index');
    Route::get('expired/obat/{slug}/bidang/{lokasi}', [ExpiredController::class, 'detailStatus'])->name('expired.status');

    Route::resource('pemesanan', PemesananController::class)->only(['index', 'edit', 'update']);
    Route::get('pemesanan/status-proses', [PemesananController::class, 'pemesananOnProses'])->name('pemesanan.proses');
    Route::get('pemesanan/status-selesai', [PemesananController::class, 'pemesananSelesai'])->name('pemesanan.selesai');

    // Merupakan detail pemesanan tapi menggunakan detail pesanan controller
    Route::get('pemesanan/status-proses/{pemesanan_id}', [DetailPesananController::class, 'detailPesananProses'])->name('pemesanan-proses.detail');
    Route::get('pemesanan/status-selesai/{pemesanan_id}', [DetailPesananController::class, 'detailPesananSelesai'])->name('pemesanan-selesai.detail');

    // UNTUK PERMINTAAN OBAT OLEH DEPO DAN PELAYANAN
    Route::resource('permintaan', PermintaanController::class)->except('show');

    Route::get('preview/{pemesanan_id}/{distributor}', [SuratController::class, 'konsep'])->name('surat.konsep');
    Route::post('preview/{pemesanan_id}/kirim', [SuratController::class, 'kirim'])->name('surat.kirim');
    Route::get('preview/status/{pemesanan_id}/{distributor}', [SuratController::class, 'status'])->name('surat.status');


    // LAPORAN
    Route::get('laporan-pemakaian', [LaporanController::class, 'pemakaianObat'])->name('laporan.pemakaian');
    Route::get('laporan-obat-keluar', [LaporanController::class, 'obatKeluar'])->name('laporan.obatKeluar');
    Route::get('laporan-keuangan', [LaporanController::class, 'rekapKeuangan'])->name('laporan.keuangan');
    Route::get('laporan-pemeriksaan', [LaporanController::class, 'pemeriksaan'])->name('laporan.pemeriksaan');

    // CETAK LAPORAN
    Route::get('laporan-pemakaian/cetak', [LaporanController::class, 'cetakPemakaianObat'])->name('cetak.laporanPemakaian');
    Route::get('laporan-obat-keluar/cetak', [LaporanController::class, 'cetakObatKeluar'])->name('cetak.laporanObatKeluar');
    Route::get('laporan-keuangan/cetak', [LaporanController::class, 'cetakRekapKeuangan'])->name('cetak.laporanKeuangan');
    Route::get('laporan-pemeriksaan/cetak', [LaporanController::class, 'cetakPemeriksaan'])->name('cetak.laporanPemeriksaan');

    // LEVEL GUDANG
    Route::group(['middleware' => 'role:gudang'], function () {
        Route::resource('distributor', DistributorController::class);
        Route::resource('pemesanan', PemesananController::class)->only(['create', 'store', 'destroy']);
        Route::get('pemesanan/detail-pesanan/{id}', [PemesananController::class, 'show'])->name('pemesanan.show');
        Route::post('pemesanan/status-proses/verif-pesanan/{detail_pesanan_id}', [DetailPesananController::class, 'verifPesanan'])->name('verif.pesanan');

        Route::resource('permintaan', PermintaanController::class)->only(['show']);
        Route::get('permintaan/status/tunda', [PermintaanController::class, 'permintaanOnProses'])->name('permintaan.tunda');
        Route::get('permintaan/status/setuju', [PermintaanController::class, 'permintaanDisetujui'])->name('permintaan.setuju');
        Route::post('permintaan/status/verif/{id}', [PermintaanController::class, 'verifPermintaan'])->name('permintaan.verif');

        // Route::resource('expired', ExpiredController::class);
        Route::post('expired/pengajuan/{id}', [ExpiredController::class, 'pengajuan'])->name('expired.pengajuan');
        Route::post('expired/pengajuan/status/{id}', [ExpiredController::class, 'statusSelesai'])->name('expired.statusSelesai');
    });

    // LEVEL DISTRIBUTOR
    Route::group(['middleware' => 'role:distributor'], function () {
        Route::get('pemesanan/daftar-pesanan', [PemesananController::class, 'pesananDistributor'])->name('pemesanan.daftar-pesanan');
        Route::post('pemesanan/status-proses/verif-pengiriman/{detail_pesanan_id}', [DetailPesananController::class, 'verifPengiriman'])->name('verif.pengiriman');

        // EXPIRED
        Route::post('expired/{id}/balas', [ExpiredController::class, 'balasan'])->name('expired.balasan');

        // LAPORAN
        Route::get('rekapan-keuangan', [LaporanController::class, 'keuanganDistributor'])->name('keuangan.distributor');
        Route::get('rekapan-keuangan/cetak', [LaporanController::class, 'cetakKeuanganDistributor'])->name('cetak.keuanganDistributor');
    });

    // LEVEL PPK
    Route::group(['middleware' => 'role:ppk'], function () {
        Route::post('pemesanan/status-proses/{pemesanan_id}/verif-ppk', [DetailPesananController::class, 'verifPPK'])->name('verif.ppk');
    });

    // LEVEL DIREKTUR
    Route::group(['middleware' => 'role:direktur'], function () {
        Route::post('pemesanan/status-proses/{pemesanan_id}/verif-direktur', [DetailPesananController::class, 'verifDirektur'])->name('verif.direktur');
    });

    // LEVEL DEPO
    Route::group(['middleware' => 'role:depo'], function () {
        Route::resource('pemakaian', PemakaianObatController::class);
    });

    // LEVEL PELAYANAN
    Route::group(['middleware' => 'role:pelayanan'], function () {
        Route::resource('tebus-obat', TebusObatController::class);
    });

    // LEVEL PELAYANAN
    Route::group(['middleware' => 'role:poli'], function () {
        Route::resource('pasien', PasienController::class);
        Route::resource('pemeriksaan', PemeriksaanController::class);
        Route::post('pemeriksaan/resep/{pemeriksaan_id}', [PemeriksaanController::class, 'storeResep'])->name('pemeriksaan.storeResep');
        Route::delete('pemeriksaan/{pemeriksaan_id}/resep/{id}', [PemeriksaanController::class, 'destroyResep'])->name('pemeriksaan.destroyResep');
    });

    // LOGOUT
    Route::match(['get', 'post'], 'logout', LogoutController::class)->name('logout');
});
