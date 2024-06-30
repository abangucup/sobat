<?php

namespace App\Http\Controllers;

use App\Models\StokObat;
use App\Models\TebusObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TebusObatController extends Controller
{
    public function index()
    {
        $tebusObats = TebusObat::with('pemeriksaan.pasien.biodata', 'pemeriksaan.reseps.stokObat')->latest()->get();

        return view('tebus.index', compact('tebusObats'));
    }

    public function update(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'status_bayar' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withToastError('Ada kesalahan. coba lagi');
        }

        if ($request->status_bayar !== 'lunas') {
            return redirect()->back()->withToastError('Ada kesalahan. coba lagi');
        } 

        $tebusObat = TebusObat::findOrFail($id);
        $tebusObat->update([
            'status_bayar' => 'lunas',
        ]);

        foreach ($tebusObat->pemeriksaan->reseps as $resep) {
            $stokObat = StokObat::findOrFail($resep->stok_obat_id);
            $stokObat->update([
                'stok' => floor(($stokObat->jumlah_stok_isi - $resep->jumlah) / $stokObat->obat->kapasitas),
                'jumlah_stok_isi' => $stokObat->jumlah_stok_isi - $resep->jumlah,
            ]);
        }

        return redirect()->back()->withToastSuccess('Obat telah ditebus');
    }
}
