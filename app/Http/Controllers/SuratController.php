<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Models\Pemesanan;
use App\Models\Surat;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratController extends Controller
{
    public function konsep($pemesanan_id, $distributor)
    {
        $pemesanan = Pemesanan::with(
            [
                'obats.distributor',
                'obats.detailPesanans',
                'obats.stokObats'
            ]
        )->findOrFail($pemesanan_id);
        foreach ($pemesanan->obats->groupBy('distributor.nama_perusahaan') as $key => $dataObat) {
            if ($key == $distributor) {
                $pdf = Pdf::loadView('pemesanan.surat-pesanan.konsep_surat_pemesanan', ['distributor' => $key], compact('pemesanan', 'dataObat'))
                    ->setPaper('A4', 'potrait');
                return $pdf->stream('konsep-urat-pemesanan-obat.pdf');
            }
        }
    }

    public function kirim($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        // FORMAT 445/RSUD.O/NOMOR/BULAN/TAHUN

        foreach ($pemesanan->obats->groupBy('distributor.id') as $distributor => $dataObat) {
            // Mendapatkan ID surat terakhir atau mengatur nilai default menjadi 1
            $latest_surat = Surat::latest()->first();
            $nomor = $latest_surat ? $latest_surat->id + 1 : 1;

            // // PEMBUATAN NOMOR SURAT
            $surat = new Surat();
            $surat->pemesanan_id = $pemesanan->id;
            $surat->distributor_id = $distributor;
            $surat->nomor_surat = '445/RSUD.O/' . $nomor . '/' . date('n') . '/' . date('Y');
            $surat->save();
        }

        // simpan perubahan pemesanan
        $pemesanan->update([
            'status_kirim_naskah' => 'terkirim',
            'status_pemesanan' => 'proses',
        ]);


        return to_route('pemesanan.index')->withToastSuccess('Surat berhasil dikirim');
    }

    public function status($pemesanan_id, $distributor)
    {
        $pemesanan = Pemesanan::with(
            [
                'obats.distributor',
                'obats.detailPesanans',
                'obats.stokObats'
            ]
        )->findOrFail($pemesanan_id);
        foreach ($pemesanan->obats->groupBy('distributor.nama_perusahaan') as $key => $dataObat) {
            if ($key == $distributor) {
                $distributor = Distributor::where('nama_perusahaan', $key)->first();
                $pdf = Pdf::loadView('pemesanan.surat-pesanan.surat_pemesanan', compact('distributor', 'pemesanan', 'dataObat'))
                    ->setPaper('A4', 'potrait');
                return $pdf->stream('surat-pemesanan-obat.pdf');
            }
        }
    }
}
