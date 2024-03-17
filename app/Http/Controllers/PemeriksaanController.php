<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pemeriksaan;
use App\Models\Resep;
use App\Models\StokObat;
use App\Models\TebusObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PemeriksaanController extends Controller
{
    public function index()
    {
        $pemeriksaans = Pemeriksaan::with('pasien.biodata')->latest()->get();
        return view('pemeriksaan.index', compact('pemeriksaans'));
    }

    public function create()
    {
        $pasiens = Pasien::with('biodata')->latest()->get();
        return view('pemeriksaan.create', compact('pasiens'));
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'pasien' => 'required',
            'diagnosis' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withInput()->withToastError('Lengkapi datanya');
        }

        $pasien = Pasien::where('no_register', $request->pasien)->first();

        $pemeriksaan = new Pemeriksaan();
        $pemeriksaan->pasien_id = $pasien->id;
        $pemeriksaan->diagnosis = $request->diagnosis;
        $pemeriksaan->save();

        $tebusObat = new TebusObat();
        $tebusObat->pemeriksaan_id = $pemeriksaan->id;
        $tebusObat->save();

        return redirect()->route('pemeriksaan.show', $pemeriksaan->id)->withToastSuccess('Silahkan tambahkan resep untuk ditebus pasien');
    }

    public function show($id)
    {
        $dataObats = StokObat::where('lokasi', 'pelayanan')
            ->whereHas('obat', function ($query) {
                $query->where('tanggal_kedaluwarsa', '>', now()->copy()->addMonths(6));
            })
            ->where('stok', '>', 0)
            ->latest()->get();
        $pemeriksaan = Pemeriksaan::findOrFail($id);
        $reseps = $pemeriksaan->reseps()->latest()->get();
        return view('pemeriksaan.show', compact('pemeriksaan', 'dataObats', 'reseps'));
    }

    public function edit($id)
    {
        $pasiens = Pasien::latest()->get();
        $pemeriksaan = Pemeriksaan::findOrFail($id);
        return view('pemeriksaan.edit', compact('pemeriksaan', 'pasiens'));
    }

    public function update(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'pasien' => 'required',
            'diagnosis' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withInput()->withToastError('Lengkapi datanya');
        }

        $pasien = Pasien::where('no_register', $request->pasien)->first();

        $pemeriksaan = Pemeriksaan::findOrFail($id);
        $pemeriksaan->update([
            'pasien_id' => $pasien->id,
            'diagnosis' => $request->diagnosis,
        ]);

        return redirect()->route('pemeriksaan.show', $pemeriksaan->id)->withToastSuccess('Silahkan periksa kembali resep');
    }

    public function destroy($id)
    {
        $pemeriksaan = Pemeriksaan::findOrFail($id);
        if ($pemeriksaan->tebusObat->status_bayar === 'lunas') {
            return redirect()->back()->withToastError('Resep telah ditebus');
        }
        $pemeriksaan->delete();

        return redirect()->back()->withToastSuccess('Pemeriksaan berhasil dihapus');
    }

    public function storeResep(Request $request, $pemeriksaan_id)
    {
        $validasi = Validator::make($request->all(), [
            'stok_obat_id' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required'
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withInput()->withToastError('Lengkapi datanya');
        }

        $pemeriksaan = Pemeriksaan::findOrFail($pemeriksaan_id);
        if ($pemeriksaan->tebusObat->status_bayar === 'lunas') {
            return redirect()->back()->withToastError('Resep telah ditebus');
        }

        $resep = new Resep();
        $resep->pemeriksaan_id = $pemeriksaan_id;
        $resep->stok_obat_id = $request->stok_obat_id;
        $resep->jumlah = $request->jumlah;
        $resep->keterangan = $request->keterangan;
        $resep->save();

        return redirect()->back()->withToastSuccess('Resep ditambahkan');
    }

    public function destroyResep($pemeriksaan_id, $id)
    {
        $pemeriksaan = Pemeriksaan::findOrFail($pemeriksaan_id);
        $resep = Resep::findOrFail($id);
        if ($pemeriksaan->tebusObat->status_bayar === 'lunas') {
            return redirect()->back()->withToastError('Resep telah ditebus');
        }
        $resep->delete();
        return redirect()->back()->withToastSuccess('Resep dihapus');
    }
}
