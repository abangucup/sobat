<?php

namespace App\Http\Controllers;

use App\Models\PemakaianObat;
use App\Models\StokObat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PemakaianObatController extends Controller
{
    public function index()
    {
        $tanggalSekarang = Carbon::parse(now());

        $dataObats = StokObat::where('lokasi', 'depo')->with('obat')
            ->whereHas('obat', function ($query) use ($tanggalSekarang) {
                $query->where('tanggal_kedaluwarsa', '>', $tanggalSekarang->addMonths(6));
            })->latest()->get();
        $pemakaians = PemakaianObat::with('stokObat.obat')->latest()->get();
        return view('pemakaian.index', compact('pemakaians', 'dataObats'));
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'stok_obat_id' => 'required',
            'tanggal_pemakaian' => 'required',
            'banyak' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->withInput()->withToastError('Kayaknya terjadi kesalahan saat pengisian, coba lagi');
        }

        $pemakaian = new PemakaianObat();
        $pemakaian->stok_obat_id = $request->stok_obat_id;
        $pemakaian->banyak = $request->banyak;
        $pemakaian->tanggal_pemakaian = $request->tanggal_pemakaian;
        $pemakaian->catatan = $request->catatan ?? null;
        $pemakaian->save();

        $stokObat = $pemakaian->stokObat;
        $stokObat->update([
            'stok' => $stokObat->stok - $pemakaian->banyak,
        ]);

        return redirect()->back()->withToastSuccess('Berhasil menambahkan pemakaian obat hari ini');
    }

    public function update(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'stok_obat_id' => 'required',
            'tanggal_pemakaian' => 'required',
            'banyak' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->withInput()->withToastError('Kayaknya terjadi kesalahan saat pengisian, coba lagi');
        }

        $pemakaian = PemakaianObat::findOrFail($id);
        $stok = $pemakaian->stokObat->stok;

        // Kembalikan stok awal
        $pemakaian->stokObat->update([
            'stok' => $stok + $pemakaian->banyak,
        ]);

        // 
        $pemakaian->update([
            'stok_obat_id' => $request->stok_obat_id,
            'banyak' => $request->banyak,
            'tanggal_pemakaian' => $request->tanggal_pemakaian,
            'catatan' => $request->catatan ?? null,

        ]);

        // update stok yang sesuai dengan pemakaian
        $stokObat = $pemakaian->stokObat;
        $stokObat->update([
            'stok' => $stokObat->stok - $pemakaian->banyak,
        ]);

        return redirect()->back()->withToastSuccess('Pemakaian berhasil dirubah');
    }

    public function destroy($id)
    {
        $pemakaian = PemakaianObat::findOrFail($id);
        $stok = $pemakaian->stokObat->stok;

        $pemakaian->stokObat->update([
            'stok' => $stok + $pemakaian->banyak,
        ]);

        $pemakaian->delete();

        return redirect()->back()->withToastSuccess('Pemakaian telah dihapus');
    }
}
