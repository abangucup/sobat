<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\PemakaianObat;
use App\Models\Pemeriksaan;
use App\Models\Resep;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function keuanganDistributor()
    {
        $user = Auth::user();

        $dataPesanans = DetailPesanan::with('obat.distributor', 'pemesanan.user.biodata', 'verif')
            ->whereHas('obat.distributor', function ($query) use ($user) {
                $query->where('slug', $user->distributor->slug);
            })->whereHas('pemesanan', function ($query) {
                $query->where('status_pemesanan', 'selesai');
            })->latest()->get();

        return view('laporan.laporan_keuangan_distributor', compact('dataPesanans'));
    }
    public function cetakKeuanganDistributor()
    {
        $user = Auth::user();

        $dataPesanans = DetailPesanan::with('obat.distributor', 'pemesanan.user.biodata', 'verif')
            ->whereHas('obat.distributor', function ($query) use ($user) {
                $query->where('slug', $user->distributor->slug);
            })->whereHas('pemesanan', function ($query) {
                $query->where('status_pemesanan', 'selesai');
            })->latest()->get();
        $pdf = Pdf::loadView('laporan.export.cetak_laporan_keuangan_distributor', compact('dataPesanans', 'user'))
            ->setPaper('A4', 'landscape');
        return $pdf->stream('laporan-rekapan-keuangan-' . Carbon::parse(now())->isoFormat('LL') . '.pdf');
    }

    public function pemakaianObat()
    {
        $pemakaians = PemakaianObat::latest()->get();
        return view('laporan.laporan_pemakaian', compact('pemakaians'));
    }

    public function cetakPemakaianObat()
    {
        $pemakaians = PemakaianObat::with('stokObat.obat')->latest()->get();
        $pdf = Pdf::loadView('laporan.export.cetak_laporan_pemakaian', compact('pemakaians'))
            ->setPaper('A4', 'landscape');
        return $pdf->stream('laporan-pemakaian-obat-' . Carbon::parse(now())->isoFormat('LL') . '.pdf');
    }

    public function obatKeluar()
    {
        $obatKeluars = Resep::with('pemeriksaan.tebusObat', 'stokObat.obat')
            ->whereHas('pemeriksaan.tebusObat', function ($query) {
                $query->where('status_bayar', 'lunas');
            })
            ->latest()->get();
        return view('laporan.laporan_obat_keluar', compact('obatKeluars'));
    }

    public function cetakObatKeluar()
    {
        $obatKeluars = Resep::with('pemeriksaan.tebusObat', 'stokObat.obat')
            ->whereHas('pemeriksaan.tebusObat', function ($query) {
                $query->where('status_bayar', 'lunas');
            })
            ->latest()->get();
        $pdf = Pdf::loadView('laporan.export.cetak_laporan_obat_keluar', compact('obatKeluars'))
            ->setPaper('A4', 'landscape');
        return $pdf->stream('laporan-obat-keluar' . Carbon::parse(now())->isoFormat('LL') . '.pdf');
    }

    public function rekapKeuangan()
    {
        $obatKeluars = Resep::with('pemeriksaan.tebusObat', 'stokObat.obat')
            ->whereHas('pemeriksaan.tebusObat', function ($query) {
                $query->where('status_bayar', 'lunas');
            })
            ->latest()->get();
        return view('laporan.laporan_keuangan', compact('obatKeluars'));
    }

    public function cetakRekapKeuangan()
    {
        $obatKeluars = Resep::with('pemeriksaan.tebusObat', 'stokObat.obat')
            ->whereHas('pemeriksaan.tebusObat', function ($query) {
                $query->where('status_bayar', 'lunas');
            })
            ->latest()->get();
        $pdf = Pdf::loadView('laporan.export.cetak_laporan_keuangan', compact('obatKeluars'))
            ->setPaper('A4', 'landscape');
        return $pdf->stream('laporan-rekapan-keuangan-' . Carbon::parse(now())->isoFormat('LL') . '.pdf');
    }

    // REKAM MEDIS / PEMERIKSAAN
    public function pemeriksaan()
    {
        $pemeriksaans = Pemeriksaan::with('pasien.biodata', 'reseps')->latest()->get();
        return view('laporan.laporan_pemeriksaan', compact('pemeriksaans'));
    }

    public function cetakPemeriksaan()
    {
        $pemeriksaans = Pemeriksaan::with('pasien.biodata', 'reseps')->latest()->get();
        $pdf = Pdf::loadView('laporan.export.cetak_laporan_pemeriksaan', compact('pemeriksaans'))
            ->setPaper('A4', 'landscape');
        return $pdf->stream('laporan-rekam-medis-' . Carbon::parse(now())->isoFormat('LL') . '.pdf');
    }
}
