<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpiredController extends Controller
{
    public function index()
    {
        $tanggalSekarang = Carbon::parse(now());
        // $tanggalExpired = Carbon::parse(date('2024-08-14 11:46:03'));
        // dd($tanggalExpired <= $tanggalSekarang->addMonths(6));
        $obatExpireds = Obat::where('tanggal_kedaluwarsa', '<=', $tanggalSekarang->addMonths(6))->get();
        return view('obat.expired.index', compact('obatExpireds'));
    }
}
