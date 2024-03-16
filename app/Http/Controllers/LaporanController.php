<?php

namespace App\Http\Controllers;

use App\Models\PemakaianObat;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function keuanganDistributor()
    {
        $distributor = Auth::user()->distributor;
        dd($distributor);
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
        return $pdf->stream('laporan-pemakaian-obat-'. Carbon::parse(now())->isoFormat('LL'). '.pdf');
    }

    public function rekapKeuangan()
    {
        return view('laporan.laporan_keuangan');
    }

    public function cetakRekapKeuangan()
    {
        // $pemakaians = PemakaianObat::with('stokObat.obat')->latest()->get();
        $pdf = Pdf::loadView('laporan.export.cetak_laporan_keuangan')
            ->setPaper('A4', 'landscape');
        return $pdf->stream('laporan-pemakaian-obat-'. Carbon::parse(now())->isoFormat('LL'). '.pdf');
    }
}
