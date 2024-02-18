<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::latest()->get();
        return view('obat.index', compact('obats'));
    }

    public function update(Request $request, $slug)
    {
        $validasi = Validator::make($request->all(), []);

        $obat = Obat::where('slug', $slug)->first();
    }

    public function destroy($slug)
    {
        $obat = Obat::where('slug', $slug)->first();
        $obat->delete();
        return to_route('obat.index')->withToastSuccess('Berhasil hapus obat');
    }
}
