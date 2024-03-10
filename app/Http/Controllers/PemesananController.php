<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Obat;
use App\Models\Pemesanan;
use App\Models\StokObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PemesananController extends Controller
{
    // FUNGSI MENAMPILKAN PEMESANAN KHUSUS LEVEL DISTRIBUTOR
    public function pesananDistributor()
    {
        $pesanans = DetailPesanan::with('obat', 'pemesanan', 'pemesanan.user', 'pemesanan.surats')
            ->where('status_pengiriman', 'ditunda')
            ->whereHas('obat', function ($query) {
                $query->whereHas('distributor', function ($query) {
                    $query->where('slug', Auth::user()->distributor->slug);
                });
            })
            ->whereHas('pemesanan', function ($query) {
                $query->where('status_verif_direktur', 'diverifikasi');
            })
            ->latest()->get();

        return view('pemesanan.distributor.daftar-pesanan', compact('pesanans'));
    }

    // LEVEL GUDANG
    public function index()
    {
        $pemesanans = Pemesanan::with(['user', 'user.biodata', 'detailPesanans'])
            ->latest()->get();
        return view('pemesanan.index', compact('pemesanans'));
    }

    public function pemesananOnProses()
    {
        $user = Auth::user();
        $pemesanans = Pemesanan::where('status_kirim_naskah', 'terkirim')
            ->where('status_pemesanan', 'proses')
            ->latest()->get();

        return view('pemesanan.pesanan-diproses', compact('pemesanans', 'user'));
    }

    public function pemesananSelesai()
    {
        $pemesanans = Pemesanan::where('status_kirim_naskah', 'terkirim')
            ->where('status_pemesanan', 'selesai')
            ->latest()->get();
        return view('pemesanan.pesanan-selesai', compact('pemesanans'));
    }

    public function create()
    {
        $stokObats = StokObat::with('obat')->where('lokasi', 'distributor')->latest()->get();
        return view('pemesanan.buat-pesanan', compact('stokObats'));
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'obat.*' => 'required|exists:obats,id', // memastikan id obat ada di database
            'banyak.*' => 'required|integer|min:1'  // memastikan jumlah obat 
        ]);

        if ($validasi->fails()) {
            return redirect()->back()
                ->withToastError('Mohon lengkapi form pemesanan obat');
        }

        $validasiStok = true;

        for ($i = 0; $i < count($request->obat); $i++) {
            $obat = StokObat::where('obat_id', $request->obat[$i])
                ->where('lokasi', 'distributor')
                ->first();

            if ($request->banyak[$i] > $obat->stok) {
                $validasiStok = false;
                break;
            }
        }

        if ($validasiStok) {

            $pemesanan = new Pemesanan();
            $pemesanan->user_id = auth()->user()->id;
            $pemesanan->keterangan = $request->keterangan ?? null;
            $pemesanan->save();

            for ($i = 0; $i < count($request->obat); $i++) {

                $obat = StokObat::where('obat_id', $request->obat[$i])
                    ->where('lokasi', 'distributor')
                    ->first();

                $detailPesanan = DetailPesanan::where('pemesanan_id', $pemesanan->id)
                    ->where('obat_id', $obat->id)
                    ->first();

                if ($detailPesanan) {
                    $jumlahPesanan = $detailPesanan->jumlah + $request->banyak[$i];
                    $detailPesanan->update([
                        'jumlah' => $jumlahPesanan,
                        'harga_pesanan' => ($obat->harga_jual * $jumlahPesanan),
                    ]);
                } else {
                    $detailPesanan = new DetailPesanan();
                    $detailPesanan->pemesanan_id = $pemesanan->id;
                    $detailPesanan->obat_id = $request->obat[$i];
                    $detailPesanan->jumlah = $request->banyak[$i];
                    $detailPesanan->harga_pesanan = ($obat->harga_jual * $request->banyak[$i]);
                    $detailPesanan->save();
                }

                $obat->update([
                    'stok' => $obat->stok - $request->banyak[$i],
                ]);
            }
        } else {
            return redirect()->back()
                ->withInput()
                ->withToastError('Banyak permintaan obat melebihi stok yang ada');
        }

        return to_route('pemesanan.index')->withToastSuccess('Berhasil disimpan sebagai draft');
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::with(
            [
                'obats.distributor',
                'obats.detailPesanans',
                'obats.stokObats'
            ]
        )->findOrFail($id);

        return view('pemesanan.show', compact('pemesanan'));
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        if ($pemesanan->status_kirim_naskah == 'pending') {
            foreach ($pemesanan->detailPesanans as $detailPesanan) {
                $obat = Obat::findOrFail($detailPesanan->obat_id);
                $stokObat = $obat->stokObats->where('lokasi', 'distributor')->first();
                $stokObat->update([
                    'stok' => $stokObat->stok + $detailPesanan->jumlah,
                ]);
            }
            $pemesanan->delete();
        } else {
            return to_route('pemesanan.index')->withToastError('Pesanan anda sedang di proses.');
        }

        return to_route('pemesanan.index')->withToastSuccess('Berhasil hapus pemesanan');
    }
}
