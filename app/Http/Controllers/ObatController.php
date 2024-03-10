<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Models\Obat;
use App\Models\StokObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ObatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        switch ($user->role) {
            case 'distributor':
                $distributor_id = $user->akunDistributor->distributor_id;
                $obats = Obat::with('stokObats')->whereHas('stokObats', function ($query) use ($distributor_id) {
                    $query->where('lokasi', 'distributor')
                        ->where('distributor_id', $distributor_id);
                })->latest()->get();
                break;
            case 'gudang':
                $obats = Obat::with('stokObats')->whereHas('stokObats', function ($query) {
                    $query->where('lokasi', 'gudang');
                })->latest()->get();
                break;
            case 'pelayanan':
                $obats = Obat::whereHas('stokObats', function ($query) {
                    $query->where('lokasi', 'pelayanan');
                })->with('stokObats')->latest()->get();
                break;
            case 'depo':
                $obats = Obat::whereHas('stokObats', function ($query) {
                    $query->where('lokasi', 'depo');
                })->with('stokObats')->latest()->get();
                break;
            default:
                Alert::error('Error', 'Obat tidak ada');
                return redirect()->back();
        }

        return view('obat.index', compact('obats'));
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama_obat' => 'required',
            'no_batch' => 'required',
            'satuan' => 'required',
            'tanggal_kedaluwarsa' => 'required',
            'stok' => 'required',
            'harga_beli' => 'required',
            'tanggal_beli' => 'required',
            'harga_jual' => 'required',
        ]);

        if ($validasi->fails()) {
            return back()->withErrors($validasi)->withInput()->withToastError('Terjadi kesalahan');
        }

        $distributor = Distributor::whereHas('akuns', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->first('id');

        $obat = new Obat();
        $obat->kode_obat = '#' . Str::upper(substr(Str::uuid(), 0, 6));
        $obat->nama_obat = $request->nama_obat;
        $obat->slug = Str::slug($request->nama_obat);
        $obat->no_batch = $request->no_batch;
        $obat->satuan = $request->satuan;
        $obat->tanggal_kedaluwarsa = $request->tanggal_kedaluwarsa;
        $obat->kapasitas = $request->kapasitas ?? null;
        $obat->satuan_kapasitas = $request->satuan_kapasitas ?? null;
        $obat->save();

        $stokObat = new StokObat();
        $stokObat->distributor_id = $distributor->id;
        $stokObat->obat_id = $obat->id;
        $stokObat->stok = $request->stok;
        $stokObat->harga_beli = preg_replace('/[^\d]/', '', $request->harga_beli);
        $stokObat->tanggal_beli = $request->tanggal_beli;
        $stokObat->harga_jual = preg_replace('/[^\d]/', '', $request->harga_jual);
        $stokObat->lokasi = 'distributor';
        $stokObat->save();

        return redirect()->back()->withToastSuccess('Berhasil tambah obat');
    }

    public function show($slug)
    {
        $obat = Obat::with('stokObats')->where('slug', $slug)->first();
        return view('obat.show', compact('obat'));
    }

    public function update(Request $request, $slug)
    {
        $validasi = Validator::make($request->all(), [
            'nama_obat' => 'required',
            'no_batch' => 'required',
            'tanggal_kedaluwarsa' => 'required',
            'satuan' => 'required',
            'stok' => 'required',
            'harga_beli' => 'required',
            'tanggal_beli' => 'required',
            'harga_jual' => 'required',

        ]);

        if ($validasi->fails()) {
            return redirect()->back()
                ->withErrors($validasi)
                ->withInput()
                ->withToastError('Lengkapi form yang wajib diisi');
        }

        $obat = Obat::where('slug', $slug)->first();
        if (!$obat) {
            return redirect()->back()->withToastError('Data obat tidak ditemukan');
        } else {
            // rubada data obat
            $obat->update([
                'nama_obat' => $request->nama_obat,
                'slug' => Str::slug($request->nama_obat),
                'no_batch' => $request->no_batch,
                'satuan' => $request->satuan,
                'tanggal_kedaluwarsa' => $request->tanggal_kedaluwarsa,
                'kapasitas' => $request->kapasitas ?? '',
                'satuan_kapasitas' => $request->satuan_kapasitas ?? '',
            ]);

            // rubah data stok obat
            $obat->stokObats->first()->update([
                'stok' => $request->stok,
                'harga_beli' => preg_replace('/[^\d]/', '', $request->harga_beli),
                'tanggal_beli' => $request->tanggal_beli,
                'harga_jual' => preg_replace('/[^\d]/', '', $request->harga_jual),
            ]);
        }

        return redirect()->back()->withToastSuccess('Berhasil merubah data obat');
    }

    public function destroy($slug)
    {
        $obat = Obat::where('slug', $slug)->first();
        $obat->delete();
        return to_route('obat.index')->withToastSuccess('Berhasil hapus obat');
    }
}
