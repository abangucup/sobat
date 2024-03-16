<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Distributor;
use App\Models\Expired;
use App\Models\Obat;
use App\Models\Pemesanan;
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
        $tanggalSekarang = Carbon::parse(now());

        if ($user->role == 'distributor') {
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
        } elseif ($user->role == 'gudang') {
            $totalObat = Obat::where('tanggal_kedaluwarsa', '>', $tanggalSekarang->addMonths(6))
                ->whereHas('stokObats', function ($query) {
                    $query->where('lokasi', '!=', 'distributor');
                })
                ->count();
            $totalExpired = Obat::where('tanggal_kedaluwarsa', '<=', $tanggalSekarang->addMonths(6))
                ->whereHas('stokObats', function ($query) {
                    $query->where('lokasi', '!=', 'distributor');
                })
                ->count();

            return view('dashboard.gudang', compact([
                'totalObat',
                'totalExpired'
            ]));
        } elseif ($user->role == 'pelayanan') {
            return view('dashboard.pelayanan');
        } elseif ($user->role == 'depo') {
            return view('dashboard.depo');
        } elseif ($user->role == 'ppk') {
            return view('dashboard.ppk');
        } elseif ($user->role == 'direktur') {
            return view('dashboard.direktur');
        } elseif ($user->role == 'poli') {
            return view('dashboard.poli');
        } else {
            Auth::logout();
            return redirect('login')->withToastInfo('Anda terindikasi penyusup');
        }
    }
}
