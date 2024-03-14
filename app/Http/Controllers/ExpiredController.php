<?php

namespace App\Http\Controllers;

use App\Models\Expired;
use App\Models\Obat;
use App\Models\StokObat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpiredController extends Controller
{
    public function index()
    {
        $tanggalSekarang = Carbon::parse(now());
        // $tanggalExpired = Carbon::parse(date('2024-08-14 11:46:03'));
        // dd($tanggalExpired <= $tanggalSekarang->addMonths(6));
        // $obatExpireds = Obat::where('tanggal_kedaluwarsa', '<=', $tanggalSekarang->addMonths(6))->get();
        $obatExpireds = StokObat::with('obat', 'distributor')
            ->whereHas('obat', function ($query) use ($tanggalSekarang) {
                $query->where('tanggal_kedaluwarsa', '<=', $tanggalSekarang->addMonths(6));
            })->where('lokasi', '!=', 'distributor')->get();
        return view('obat.expired.index', compact('obatExpireds'));
    }

    public function pengajuan(Request $request, $id)
    {
        $stokObat = StokObat::findOrFail($id);

        $pengembalian = new Expired();
        $pengembalian->stok_obat_id = $id;
        $pengembalian->catatan = $request->catatan ?? null;
        $pengembalian->save();

        return redirect()->back()->withToastSuccess('Pengembalian di ajukan ke distributor');
    }
}
