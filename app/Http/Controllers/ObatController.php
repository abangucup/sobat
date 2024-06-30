<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Models\Obat;
use App\Models\StokObat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ObatController extends Controller
{
    public function index()
    {
        $tanggalSekarang = Carbon::parse(now());
        $user = Auth::user();
        switch ($user->role) {
            case 'distributor':
                $distributor_id = $user->akunDistributor->distributor_id;
                $obats = StokObat::with('obat', 'distributor')->where('lokasi', 'distributor')->where('distributor_id', $distributor_id)->latest()->get();
                break;
            case 'gudang':
                $obats = StokObat::with('obat', 'distributor')->where('lokasi', 'gudang')
                    ->whereHas('obat', function ($query) use ($tanggalSekarang) {
                        $query->where('tanggal_kedaluwarsa', '>', $tanggalSekarang->addMonths(6));
                    })
                    ->latest()->get();
                break;
            case 'pelayanan':
                $obats = StokObat::with('obat', 'distributor')->where('lokasi', 'pelayanan')->latest()->get();
                break;
            case 'depo':
                $obats = StokObat::with('obat', 'distributor')->where('lokasi', 'depo')->latest()->get();
                break;
            default:
                Alert::error('Error', 'Obat tidak ada');
                return redirect()->back();
        }
        $distributors = Distributor::all();

        return view('obat.index', compact('obats', 'user', 'distributors'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role != 'distributor' && auth()->user()->role != 'gudang') {
            return back()->withInput()->withToastError('Anda tidak memiliki akses');
        }

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
        if (!$request->distributor_id) {
            $distributor = Distributor::whereHas('akuns', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->first()->id;

            $stokObat->distributor_id = $distributor;
            $stokObat->lokasi = 'distributor';
        } else {
            $stokObat->distributor_id = $request->distributor_id;
            $stokObat->lokasi = 'gudang';
        }
        $stokObat->obat_id = $obat->id;
        $stokObat->stok = $request->stok;
        $stokObat->jumlah_stok_isi = $request->stok * $obat->kapasitas;
        $stokObat->harga_beli = preg_replace('/[^\d]/', '', $request->harga_beli);
        $stokObat->tanggal_beli = $request->tanggal_beli;
        $stokObat->harga_jual = preg_replace('/[^\d]/', '', $request->harga_jual);
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
        if (auth()->user()->role != 'distributor' && auth()->user()->role != 'gudang') {
            return back()->withInput()->withToastError('Anda tidak memiliki akses');
        }
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
            // if ($obat->stokObats->where('lokasi', '!=', 'distributor')->first() == null) {
            # code...
            $obat->update([
                'nama_obat' => $request->nama_obat,
                'slug' => Str::slug($request->nama_obat),
                'no_batch' => $request->no_batch,
                'satuan' => $request->satuan,
                'tanggal_kedaluwarsa' => $request->tanggal_kedaluwarsa,
                'kapasitas' => $request->kapasitas ?? null,
                'satuan_kapasitas' => $request->satuan_kapasitas ?? null,
            ]);

            // rubah data stok obat
            $obat->stokObats()->where('lokasi', auth()->user()->role)->first()->update([
                'stok' => $request->stok,
                'jumlah_stok_isi' => $request->stok * $obat->kapasitas, 
                'harga_beli' => preg_replace('/[^\d]/', '', $request->harga_beli),
                'tanggal_beli' => $request->tanggal_beli,
                'harga_jual' => preg_replace('/[^\d]/', '', $request->harga_jual),
            ]);
            if (!$request->distributor_id) {
                $distributor = Distributor::whereHas('akuns', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })->first()->id;

                $obat->stokObats()->where('lokasi', auth()->user()->role)->first()->update([
                    'distributor_id' => $distributor,
                ]);
            } else {
                $obat->stokObats()->where('lokasi', auth()->user()->role)->first()->update([
                    'distributor_id' => $request->distributor_id,
                ]);
            }

            // } else {
            //     return redirect()->back()->withToastError('Data obat tidak dapat dirubah lagi');
            // }
        }

        return redirect()->back()->withToastSuccess('Berhasil merubah data obat');
    }

    public function ubahHarga(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'harga_jual' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withToastError('Lengkapi data inputan');
        }

        $dataObat = StokObat::where('id', $id)->first();
        $dataObat->update([
            'harga_jual' => preg_replace('/[^\d]/', '', $request->harga_jual),
        ]);

        return redirect()->back()->withToastSuccess('Harga jual telah dirubah');
    }

    public function destroy($slug)
    {
        if (auth()->user()->role != 'distributor' && auth()->user()->role != 'gudang') {
            return back()->withInput()->withToastError('Anda tidak memiliki akses');
        }
        $obat = Obat::where('slug', $slug)->first();
        $obat->delete();
        return to_route('obat.index')->withToastSuccess('Berhasil hapus obat');
    }
}
