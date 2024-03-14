<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Obat;
use App\Models\Pemesanan;
use App\Models\StokObat;
use App\Models\VerifPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DetailPesananController extends Controller
{
    public function detailPesananProses($id)
    {
        $user = Auth::user();
        $pemesanan = Pemesanan::with(
            [
                'obats.distributor',
                'obats.detailPesanans',
                'obats.stokObats'
            ]
        )->findOrFail($id);

        if ($pemesanan && $pemesanan->status_pemesanan == 'proses') {
            return view('pemesanan.detail.detail-pesanan', compact('pemesanan', 'user'));
        } else {
            return redirect()->route('pemesanan.proses')->withToastError('Pesanan tersebut telah selesai');
        }
    }

    public function detailPesananSelesai($id)
    {
        $user = Auth::user();
        $pemesanan = Pemesanan::with(
            [
                'obats.distributor',
                'obats.detailPesanans',
                'obats.stokObats'
            ]
        )->where('status_pemesanan', 'selesai')->findOrFail($id);

        return view('pemesanan.detail.detail-pesanan', compact('pemesanan', 'user'));
    }

    // UNTUK MELAKUKAN VERIFIKASI PESANNA AGAR DIREKTUR DAPAT MELAKUKAN VERIF
    public function verifPPK(Request $request, $pemesanan_id)
    {
        $validasi = Validator::make($request->all(), [
            'status_verif_ppk' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withToastError('Maaf anda mencurigakan');
        }

        $pemesanan = Pemesanan::findOrFail($pemesanan_id);
        $pemesanan->update([
            'status_verif_ppk' => $request->status_verif_ppk,
        ]);

        return redirect()->back()->withToastSuccess('Pemesanan diverifikasi PPK');
    }

    // UNTUK MELAKUKAN VERIFIKASI PESANAN AGAR DAPAT TERBACA KE DISTRIBUTOR
    public function verifDirektur(Request $request, $pemesanan_id)
    {
        $validasi = Validator::make($request->all(), [
            'status_verif_direktur' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withToastError('Maaf anda mencurigakan');
        }

        $pemesanan = Pemesanan::findOrFail($pemesanan_id);
        $pemesanan->update([
            'status_verif_direktur' => $request->status_verif_direktur,
        ]);

        return redirect()->back()->withToastSuccess('Pemesanan diverifikasi Direktur');
    }

    // GUDANG DAPAT MELAKUKAN VERIF PESANAN JIKA BARNG SUDAH DIKIRIM DAN MEMBERIKAN CATATAN APAKAH PESANAN SESUAI
    // SEKALIGUS PENAMBAHAN DATA OBAT KE GUDANG FARMASI
    public function verifPesanan(Request $request, $detail_pesanan_id)
    {
        $validasi = Validator::make($request->all(), [
            'kondisi_pesanan' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withToastError('Lengkapi form');
        }

        $detailPesanan = DetailPesanan::findOrFail($detail_pesanan_id);

        $user = Auth::user()->id;

        $verifPesanan = new VerifPesanan();
        $verifPesanan->pemverifikasi = $user;
        $verifPesanan->detail_pesanan_id = $detail_pesanan_id;
        $verifPesanan->kondisi_pesanan = $request->kondisi_pesanan;
        $verifPesanan->catatan = $request->catatan ?? null;
        $verifPesanan->save();

        // PROSES PENAMBAHAN OBAT YANG TELAH DIBELI KE TABEL SEBAGAI DATA OBAT DARI DISTRIBUTOR
        $stokObat = StokObat::where('distributor_id', $detailPesanan->obat->distributor->id)
            ->where('obat_id', $detailPesanan->obat_id)
            ->where('lokasi', 'gudang')
            ->first();
        if (!$stokObat) {
            $stokObat = new StokObat();
            $stokObat->distributor_id = $detailPesanan->obat->distributor->id;
            $stokObat->obat_id = $detailPesanan->obat_id;
            $stokObat->stok = $detailPesanan->jumlah;
            $stokObat->harga_beli = $detailPesanan->obat->stokObats->where('lokasi', 'distributor')->pluck('harga_jual')->first();
            $stokObat->tanggal_beli = $detailPesanan->pemesanan->created_at;
            $stokObat->harga_jual = null;
            $stokObat->lokasi = 'gudang';
            $stokObat->save();
        } else {
            $stokObat->update([
                'stok' => $stokObat->stok + $detailPesanan->jumlah,
            ]);
        }

        $pemesanan = Pemesanan::findOrFail($detailPesanan->pemesanan_id);
        $pemesanan->updateStatusPemesanan();

        return redirect()->back()->withToastSuccess('Pesanan telah diverifikasi');
    }

    // FUNGSI UNTUK DISTRIBUTOR MELAKUKAN UPDATE STATUS PENGIRIMAN
    public function verifPengiriman(Request $request, $detail_pesanan_id)
    {
        $validasi = Validator::make($request->all(), [
            'status_pengiriman' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withToastError('Status tidak ditemukan');
        }

        $detailPesanan = DetailPesanan::findOrFail($detail_pesanan_id);
        $detailPesanan->update([
            'status_pengiriman' => $request->status_pengiriman,
        ]);

        return redirect()->back()->withToastSuccess('Status pengiriman telah dirubah');
    }
}
