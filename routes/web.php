<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\ExpiredController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PermintaanController;
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

    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::resource('obat', ObatController::class)->only(['index']);
    Route::resource('user', UserController::class);
    Route::resource('akun-distributor', AkunDistributor::class);
    Route::resource('expired', ExpiredController::class);

    Route::resource('pemesanan', PemesananController::class)->only(['index']);
    Route::get('pemesanan/status-proses', [PemesananController::class, 'pemesananOnProses'])->name('pemesanan.proses');
    Route::get('pemesanan/status-selesai', [PemesananController::class, 'pemesananSelesai'])->name('pemesanan.selesai');

    Route::resource('permintaan', PermintaanController::class)->except(['show']);
    Route::get('permintaan/status-tunda', [PermintaanController::class, 'permintaanOnProses'])->name('permintaan.tunda');
    Route::get('permintaan/status-setuju', [PermintaanController::class, 'permintaanDisetujui'])->name('permintaan.setuju');

    Route::get('rekapan-keuangan', function() {
        return view('keuangan.rekapan');
    })->name('keuangan.rekapan');

    Route::group(['middleware' => 'role:gudang'], function () {
        Route::resource('distributor', DistributorController::class);
        Route::resource('pemesanan', PemesananController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    });

    Route::group(['middleware' => 'role:distributor'], function () {
        Route::resource('obat', ObatController::class)->only(['store', 'update', 'destroy', 'edit', 'show']);
    });

    Route::group(['middleware' => 'role:pelayanan'], function () {
    });


    // LOGOUT
    Route::match(['get', 'post'], 'logout', LogoutController::class)->name('logout');
});
