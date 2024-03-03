<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\StokObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PemesananController extends Controller
{
    public function index()
    {
        // $pemesanans = Pemesanan::latest()->get();
        return view('pemesanan.index');
    }

    public function pemesananOnProses()
    {
        return view('pemesanan.pesanan-diproses');
    }

    public function pemesananSelesai()
    {
        return view('pemesanan.pesanan-selesai');
    }

    public function create()
    {
        $stokObats = StokObat::with('obat')->where('lokasi', 'distributor')->latest()->get();
        return view('pemesanan.buat-pesanan', compact('stokObats'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $validasi = Validator::make($request->all(), []);
    }
}
