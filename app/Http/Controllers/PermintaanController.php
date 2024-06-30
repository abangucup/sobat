<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Permintaan;
use App\Models\StokObat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PermintaanController extends Controller
{
    public function index()
    {
        $tanggalSekarang = Carbon::parse(now());

        $dataObats = StokObat::with('obat')
            ->where('lokasi', 'gudang')
            ->where('stok', '>', 0)
            ->whereHas('obat', function ($query) use ($tanggalSekarang) {
                $query->where('tanggal_kedaluwarsa', '>', $tanggalSekarang->addMonths(6));
            })
            ->latest()->get();

        $user = Auth::user();
        if ($user->role == 'gudang') {
            $permintaans = Permintaan::with('userPengaju.biodata', 'userPemverifikasi.biodata', 'stokObat.obat')
                ->latest()->get();
        } elseif ($user->role == 'depo') {
            $permintaans = Permintaan::with('userPengaju.biodata', 'userPemverifikasi.biodata', 'stokObat.obat')
                ->where('bidang', 'depo')->latest()->get();
        } elseif ($user->role == 'pelayanan') {
            $permintaans = Permintaan::with('userPengaju.biodata', 'userPemverifikasi.biodata', 'stokObat.obat')
                ->where('bidang', 'pelayanan')->latest()->get();
        }

        return view('permintaan.index', compact('permintaans', 'dataObats'));
    }

    public function permintaanOnProses()
    {
        $permintaans = Permintaan::where('status_permintaan', 'tunda')
            ->orWhere('status_permintaan', 'ditolak')->latest()->get();
        return view('permintaan.permintaan-diproses', compact('permintaans'));
    }

    public function permintaanDisetujui()
    {
        $permintaans = Permintaan::with('stokObat.obat', 'userPengaju.biodata', 'userPemverifikasi.biodata')
            ->where('status_permintaan', 'disetujui')
            ->orWhere('status_permintaan', 'selesai')->latest()->get();
        return view('permintaan.permintaan-disetujui', compact('permintaans'));
    }

    public function  store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'obat' => 'required',
            'banyak' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withToastError('Lengkapi form pengisian');
        }

        $user = Auth::user();
        $dataObat = StokObat::findOrFail($request->obat);

        if ($request->banyak > $dataObat->stok) {
            return redirect()->back()->withToastError('Permintaan melebihi stok yang ada');
        } else {

            $permintaan = new Permintaan();
            $permintaan->pengaju = $user->id;
            $permintaan->stok_obat_id = $request->obat;
            $permintaan->banyak = $request->banyak;
            $permintaan->bidang = $user->role;
            $permintaan->catatan = $request->catatan ?? null;
            $permintaan->save();

            $dataObat->update([
                'stok' => $dataObat->stok - $permintaan->banyak,
                'jumlah_stok_isi' => ($dataObat->stok - $permintaan->banyak) * $dataObat->obat->kapasitas,
            ]);
        }


        return redirect()->back()->withToastSuccess('Berhasil membuat permintaan');
    }

    public function show($id)
    {
        $permintaan = Permintaan::with('stokObat.obat', 'userPengaju.biodata', 'userPemverifikasi.biodata')->findOrFail($id);
        return view('permintaan.detail', compact('permintaan'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validasi = Validator::make($request->all(), [
            'obat' => 'required',
            'banyak' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withToastError('Lengkapi form pengisian');
        }

        $permintaan = Permintaan::findOrFail($id);

        if ($permintaan->status_permintaan === 'disetujui' || $permintaan->status_permintaan === 'selesai') {

            return redirect()->back()->withToastError('Permintaan anda sedang di proses.');
        } else {

            // ubah stok obat awal
            $stokObat = $permintaan->stokObat;
            $stokObat->update([
                'stok' => $stokObat->stok + $permintaan->banyak,
                'jumlah_stok_isi' => ($stokObat->stok + $permintaan->banyak) * $stokObat->obat->kapasitas
            ]);

            // kemudian update permintaannya
            $permintaan->update([
                'stok_obat_id' => $request->obat,
                'banyak' => $request->banyak,
            ]);
            
            $dataObat = StokObat::findOrFail($request->obat);
            // // kemudian lakukan pengurangan kembali sisa stok yang ada
            $dataObat->update([
                'stok' => $dataObat->stok - $permintaan->banyak,
                'jumlah_stok_isi' => ($dataObat->stok - $permintaan->banyak) * $dataObat->obat->kapasitas,
            ]);
        }

        return redirect()->back()->withToastSuccess('Berhasil merubah permintaan');
    }

    public function verifPermintaan(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'status_permintaan' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withToastError('Status tidak ditemukan');
        }

        $permintaan = Permintaan::findOrFail($id);
        $permintaan->update([
            'pemverifikasi' => auth()->user()->id,
            'status_permintaan' => $request->status_permintaan,
        ]);

        if ($request->status_permintaan == 'selesai') {
            // PROSES PENAMBAHAN OBAT YANG TELAH DIBELI KE TABEL SEBAGAI DATA OBAT DARI DISTRIBUTOR
            $dataObat = StokObat::where('obat_id', $permintaan->stokObat->obat_id)
                ->where('lokasi', $permintaan->userPengaju->role)
                ->first();
            if (!$dataObat) {
                $dataObat = new StokObat();
                $dataObat->distributor_id = $permintaan->stokObat->distributor_id;
                $dataObat->obat_id = $permintaan->stokObat->obat_id;
                $dataObat->stok = $permintaan->banyak;
                $dataObat->jumlah_stok_isi = $permintaan->banyak * $permintaan->stokObat->obat->kapasitas;
                $dataObat->harga_beli = $permintaan->stokObat->harga_beli;
                $dataObat->tanggal_beli = $permintaan->created_at;
                $dataObat->harga_jual = $permintaan->stokObat->harga_jual;
                $dataObat->lokasi = $permintaan->userPengaju->role;
                $dataObat->save();
            } else {
                $dataObat->update([
                    'stok' => $dataObat->stok + $permintaan->banyak,
                    'jumlah_stok_isi' => ($dataObat->stok + $permintaan->banyak) * $dataObat->obat->kapasitas,
                ]);
            }
        }

        return redirect()->route('permintaan.setuju')->withToastSuccess('Permintaan telah di verifikasi');
    }

    public function destroy($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        if ($permintaan->status_permintaan === 'disetujui' || $permintaan->status_permintaan === 'selesai') {
            return redirect()->back()->withToastError('Permintaan anda sedang di proses.');
        } else {
            $dataObat = StokObat::findOrFail($permintaan->stok_obat_id);
            $dataObat->update([
                'stok' => $dataObat->stok + $permintaan->banyak,
                'jumlah_stok_isi' => ($dataObat->stok + $permintaan->banyak) * $dataObat->obat->kapasitas
            ]);
            $permintaan->delete();
        }

        return to_route('permintaan.index')->withToastSuccess('Berhasil hapus permintaan');
    }
}
