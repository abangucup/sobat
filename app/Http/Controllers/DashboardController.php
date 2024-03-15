<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Distributor;
use App\Models\Expired;
use App\Models\Obat;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user =  Auth::user();

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
                ->latest()->paginate(5);

            $expireds = Expired::with('stokObat')->latest()->paginate(5);

            return view('dashboard.distributor', compact('totalObat', 'pesanans', 'expireds'));
        } elseif ($user->role == 'gudang') {
            return view('dashboard.gudang');
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
