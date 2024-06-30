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

        $stokObat = StokObat::where('id', $request->stok_obat_id)->first();

        if ($request->banyak <= $stokObat->jumlah_stok_isi) {
            # code...

            $pemakaian = new PemakaianObat();
            $pemakaian->stok_obat_id = $request->stok_obat_id;
            $pemakaian->banyak = $request->banyak;
            $pemakaian->tanggal_pemakaian = $request->tanggal_pemakaian;
            $pemakaian->catatan = $request->catatan ?? null;
            $pemakaian->save();

            // if (($stokObat->jumlah_stok_isi / $pemakaian->stokObat->obat->kapasitas)) {
            $stokObat->update([
                'stok' => floor(($stokObat->jumlah_stok_isi - $pemakaian->banyak) / $stokObat->obat->kapasitas),
                'jumlah_stok_isi' => $stokObat->jumlah_stok_isi - $pemakaian->banyak,
            ]);
        } else {
            return redirect()->route('permintaan.index')->withToastError('Stok telah habis, segera lakukan permintaan kembali');
        }

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

        // Kembalikan stok awal
        $returnStok = $pemakaian->banyak / $pemakaian->stokObat->obat->kapasitas;
        $pemakaian->stokObat->update([
            'stok' => $pemakaian->stokObat->stok + $returnStok,
            'jumlah_stok_isi' => $pemakaian->stokObat->jumlah_stok_isi + $pemakaian->banyak,
        ]);


        $pemakaian->update([
            'stok_obat_id' => $request->stok_obat_id,
            'banyak' => $request->banyak,
            'tanggal_pemakaian' => $request->tanggal_pemakaian,
            'catatan' => $request->catatan ?? null,

        ]);

        // update stok yang sesuai dengan pemakaian
        $stokObat = StokObat::where('id', $request->stok_obat_id)->first();
        $stokObat->update([
            'stok' => floor(($stokObat->jumlah_stok_isi - $pemakaian->banyak) / $stokObat->obat->kapasitas),
            'jumlah_stok_isi' => $stokObat->jumlah_stok_isi - $pemakaian->banyak,
        ]);

        return redirect()->back()->withToastSuccess('Pemakaian berhasil dirubah');
    }

    public function destroy($id)
    {
        $pemakaian = PemakaianObat::findOrFail($id);

        $returnStok = $pemakaian->banyak / $pemakaian->stokObat->obat->kapasitas;

        $pemakaian->stokObat->update([
            'stok' => $pemakaian->stokObat->stok + $returnStok,
            'jumlah_stok_isi' => $pemakaian->stokObat->jumlah_stok_isi + $pemakaian->banyak,
        ]);

        $pemakaian->delete();

        return redirect()->back()->withToastSuccess('Pemakaian telah dihapus');
    }
}
