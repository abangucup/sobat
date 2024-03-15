<?php

namespace App\Http\Controllers;

use App\Models\Expired;
use App\Models\Obat;
use App\Models\StokObat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExpiredController extends Controller
{
    public function index()
    {
        $tanggalSekarang = Carbon::parse(now());
        $user = Auth::user();
        if ($user->role == 'distributor') {
            $obatExpireds = StokObat::with('obat', 'distributor')->whereHas('expired')
                ->whereHas('obat', function ($query) use ($tanggalSekarang) {
                    $query->where('tanggal_kedaluwarsa', '<=', $tanggalSekarang->addMonths(6));
                })->where('lokasi', '!=', 'distributor')->get();
        } else {
            $obatExpireds = StokObat::with('obat', 'distributor')
                ->whereHas('obat', function ($query) use ($tanggalSekarang) {
                    $query->where('tanggal_kedaluwarsa', '<=', $tanggalSekarang->addMonths(6));
                })->where('lokasi', '!=', 'distributor')->get();
        }

        return view('obat.expired.index', compact('obatExpireds'));
    }

    public function pengajuan(Request $request, $id)
    {
        $pengembalian = new Expired();
        $pengembalian->stok_obat_id = $id;
        $pengembalian->catatan = $request->catatan ?? null;
        $pengembalian->save();

        return redirect()->back()->withToastSuccess('Pengembalian di ajukan ke distributor');
    }

    public function detailStatus($slug, $lokasi)
    {
        $user = Auth::user();
        $dataObat = StokObat::with('obat', 'distributor', 'expired')->whereHas('obat', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->where('lokasi', $lokasi)->first();
        return view('obat.expired.detail', compact('dataObat', 'user'));
    }

    public function balasan(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'balasan' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withToastErro('Wajib menambahkan balasan');
        }

        $expired = Expired::findOrFail($id);
        $expired->update([
            'status_pengembalian' => 'disetujui',
            'balasan' => $request->balasan,
        ]);

        return redirect()->back()->withToastSuccess('Berhasil mengirimkan balasan');
    }

    public function statusSelesai($id)
    {
        $expired = Expired::findOrFail($id);
        $expired->update([
            'status_pengembalian' => 'selesai',
        ]);

        return redirect()->back()->withToastSuccess('Pengembalian Selesai');
    }
}
