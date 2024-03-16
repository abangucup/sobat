<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Distributor;
use App\Models\Expired;
use App\Models\Obat;
use App\Models\Pemesanan;
use App\Models\Permintaan;
use App\Models\StokObat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user =  Auth::user();

        if ($user->role === 'distributor') {
            $tanggalSekarang = Carbon::parse(now());

            $totalObat = Obat::with('stokObats')->whereHas('stokObats', function ($query) use ($user) {
                $query->where('lokasi', 'distributor')
                    ->where('distributor_id', $user->akunDistributor->distributor_id);
            })->count();

            // Mengambil data pesanan yang hanya pada distributor masing masing
            // dan hanya pesanan yang status verif direkturnya sudah diverifikasi
            // dan kalau status pengirimannya masih tunda
            $pesanans = DetailPesanan::with('obat', 'pemesanan')
                ->where('status_pengiriman', 'ditunda')
                ->whereHas('obat', function ($query) use ($user) {
                    $query->with('distributor')->whereHas('distributor', function ($query) use ($user) {
                        $query->where('slug', $user->akunDistributor->distributor->slug);
                    });
                })
                ->whereHas('pemesanan', function ($query) {
                    $query->where('status_verif_direktur', 'diverifikasi');
                })
                ->latest()->get();

            $totalPemesanan = DetailPesanan::whereHas('obat.distributor', function ($query) use ($user) {
                $query->where('slug', $user->distributor->slug);
            })->count();

            $dataPesanans = DetailPesanan::with('obat.distributor', 'pemesanan.user.biodata', 'verif')
                ->whereHas('obat.distributor', function ($query) use ($user) {
                    $query->where('slug', $user->distributor->slug);
                })->whereHas('pemesanan', function ($query) {
                    $query->where('status_pemesanan', 'selesai');
                })->latest()->get();


            $totalPajak = 0;
            foreach ($dataPesanans as $dataPesanan) {
                $pajak = $dataPesanan->harga_pesanan * 0.11;
                $totalPajak += $pajak;
            }
            $totalHargaPesanan = $dataPesanans->sum('harga_pesanan');
            $total = $totalHargaPesanan + $totalPajak;

            $expireds = Expired::with('stokObat')->where('status_pengembalian', 'pending')->latest()->get();
            $totalExpired = count($expireds);

            return view('dashboard.distributor', compact([
                'totalObat',
                'pesanans',
                'expireds',
                'totalExpired',
                'totalPemesanan',
                'total'
            ]));
        } elseif ($user->role === 'gudang') {
            $tanggalSekarang = now()->copy();

            $totalObat = Obat::where('tanggal_kedaluwarsa', '>', $tanggalSekarang->copy()->addMonths(6))
                ->whereHas('stokObats', function ($query) {
                    $query->where('lokasi', '!=', 'distributor');
                })
                ->count();

            $totalExpired = Obat::where('tanggal_kedaluwarsa', '<=', $tanggalSekarang->copy()->addMonths(6))
                ->whereHas('stokObats', function ($query) {
                    $query->where('lokasi', '!=', 'distributor');
                })
                ->count();

            $totalPesananSelesai = Pemesanan::where('status_pemesanan', 'selesai')->count();
            $totalPesananProses = Pemesanan::where('status_pemesanan', '!=', 'selesai')->count();

            $permintaans = Permintaan::where('status_permintaan', 'tunda')->latest()->get();
            $totalPermintaanSelesai = Permintaan::where('status_permintaan', 'selesai')->count();
            $totalPermintaanProses = count($permintaans);

            $obatExpireds = StokObat::with('obat')
                ->whereHas('obat', function ($query) use ($tanggalSekarang) {
                    $query->where('tanggal_kedaluwarsa', '<=', $tanggalSekarang->copy()->addMonths(6));
                })
                ->where('lokasi', '!=', 'distributor')
                ->latest()
                ->get();

            return view('dashboard.gudang', compact(
                'totalObat',
                'totalExpired',
                'totalPesananSelesai',
                'totalPesananProses',
                'totalPermintaanSelesai',
                'totalPermintaanProses',
                'permintaans',
                'obatExpireds'
            ));
        } elseif ($user->role == 'pelayanan') {
            $tanggalSekarang = now()->copy();

            $totalObat = Obat::where('tanggal_kedaluwarsa', '>', $tanggalSekarang->copy()->addMonths(6))
                ->whereHas('stokObats', function ($query) {
                    $query->where('lokasi', 'pelayanan');
                })
                ->count();

            $totalExpired = Obat::where('tanggal_kedaluwarsa', '<=', $tanggalSekarang->copy()->addMonths(6))
                ->whereHas('stokObats', function ($query) {
                    $query->where('lokasi', 'pelayanan');
                })
                ->count();

            $totalPermintaanSelesai = Permintaan::where('status_permintaan', 'selesai')->where('bidang', 'pelayanan')->count();
            $totalPermintaanProses = Permintaan::where('status_permintaan', 'tunda')->where('bidang', 'pelayanan')->count();

            $obatExpireds = StokObat::with('obat')
                ->whereHas('obat', function ($query) use ($tanggalSekarang) {
                    $query->where('tanggal_kedaluwarsa', '<=', $tanggalSekarang->copy()->addMonths(6));
                })
                ->where('lokasi', 'pelayanan')
                ->latest()
                ->get();

            return view('dashboard.pelayanan', compact(
                'totalObat',
                'totalExpired',
                'totalPermintaanSelesai',
                'totalPermintaanProses',
                'obatExpireds'
            ));
        } elseif ($user->role == 'depo') {
            $tanggalSekarang = now()->copy();

            $totalObat = Obat::where('tanggal_kedaluwarsa', '>', $tanggalSekarang->copy()->addMonths(6))
                ->whereHas('stokObats', function ($query) {
                    $query->where('lokasi', 'depo');
                })
                ->count();

            $totalExpired = Obat::where('tanggal_kedaluwarsa', '<=', $tanggalSekarang->copy()->addMonths(6))
                ->whereHas('stokObats', function ($query) {
                    $query->where('lokasi', 'depo');
                })
                ->count();

            $totalPermintaanSelesai = Permintaan::where('status_permintaan', 'selesai')->where('bidang', 'depo')->count();
            $totalPermintaanProses = Permintaan::where('status_permintaan', 'tunda')->where('bidang', 'depo')->count();

            $obatExpireds = StokObat::with('obat')
                ->whereHas('obat', function ($query) use ($tanggalSekarang) {
                    $query->where('tanggal_kedaluwarsa', '<=', $tanggalSekarang->copy()->addMonths(6));
                })
                ->where('lokasi','depo')
                ->latest()
                ->get();

            return view('dashboard.depo', compact(
                'totalObat',
                'totalExpired',
                'totalPermintaanSelesai',
                'totalPermintaanProses',
                'obatExpireds'
            ));
        } elseif ($user->role == 'ppk') {
            $tanggalSekarang = now()->copy();

            $totalObat = Obat::where('tanggal_kedaluwarsa', '>', $tanggalSekarang->copy()->addMonths(6))
                ->whereHas('stokObats', function ($query) {
                    $query->where('lokasi', '!=', 'distributor');
                })
                ->count();

            $totalExpired = Obat::where('tanggal_kedaluwarsa', '<=', $tanggalSekarang->copy()->addMonths(6))
                ->whereHas('stokObats', function ($query) {
                    $query->where('lokasi', '!=', 'distributor');
                })
                ->count();

            $totalPesananSelesai = Pemesanan::where('status_pemesanan', 'selesai')->count();
            $totalPesananProses = Pemesanan::where('status_pemesanan', '!=', 'selesai')->count();

            $permintaans = Permintaan::where('status_permintaan', 'tunda')->latest()->get();
            $totalPermintaanSelesai = Permintaan::where('status_permintaan', 'selesai')->count();
            $totalPermintaanProses = count($permintaans);

            $obatExpireds = StokObat::with('obat')
                ->whereHas('obat', function ($query) use ($tanggalSekarang) {
                    $query->where('tanggal_kedaluwarsa', '<=', $tanggalSekarang->copy()->addMonths(6));
                })
                ->where('lokasi', '!=', 'distributor')
                ->latest()
                ->get();

            return view('dashboard.ppk', compact(
                'totalObat',
                'totalExpired',
                'totalPesananSelesai',
                'totalPesananProses',
                'totalPermintaanSelesai',
                'totalPermintaanProses',
                'permintaans',
                'obatExpireds'
            ));
        } elseif ($user->role == 'direktur') {
            $tanggalSekarang = now()->copy();

            $totalObat = Obat::where('tanggal_kedaluwarsa', '>', $tanggalSekarang->copy()->addMonths(6))
                ->whereHas('stokObats', function ($query) {
                    $query->where('lokasi', '!=', 'distributor');
                })
                ->count();

            $totalExpired = Obat::where('tanggal_kedaluwarsa', '<=', $tanggalSekarang->copy()->addMonths(6))
                ->whereHas('stokObats', function ($query) {
                    $query->where('lokasi', '!=', 'distributor');
                })
                ->count();

            $totalPesananSelesai = Pemesanan::where('status_pemesanan', 'selesai')->count();
            $totalPesananProses = Pemesanan::where('status_pemesanan', '!=', 'selesai')->count();

            $permintaans = Permintaan::where('status_permintaan', 'tunda')->latest()->get();
            $totalPermintaanSelesai = Permintaan::where('status_permintaan', 'selesai')->count();
            $totalPermintaanProses = count($permintaans);

            $obatExpireds = StokObat::with('obat')
                ->whereHas('obat', function ($query) use ($tanggalSekarang) {
                    $query->where('tanggal_kedaluwarsa', '<=', $tanggalSekarang->copy()->addMonths(6));
                })
                ->where('lokasi', '!=', 'distributor')
                ->latest()
                ->get();

            return view('dashboard.direktur', compact(
                'totalObat',
                'totalExpired',
                'totalPesananSelesai',
                'totalPesananProses',
                'totalPermintaanSelesai',
                'totalPermintaanProses',
                'permintaans',
                'obatExpireds'
            ));
        } elseif ($user->role == 'poli') {

            return view('dashboard.poli');
        } else {
            Auth::logout();
            return redirect('login')->withToastInfo('Anda terindikasi penyusup');
        }
    }
}
