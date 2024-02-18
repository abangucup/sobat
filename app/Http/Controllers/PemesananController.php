<?php

namespace App\Http\Controllers;

use App\Models\StokObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PemesananController extends Controller
{
    public function create()
    {
        $stokObats = StokObat::with('obat')->where('lokasi', 'distributor')->latest()->get();
        return view('pemesanan.buat-pesanan', compact('stokObats'));
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), []);
    }
}
