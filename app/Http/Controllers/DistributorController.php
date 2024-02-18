<?php

namespace App\Http\Controllers;

use App\Models\AkunDistributor;
use App\Models\Biodata;
use App\Models\Distributor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DistributorController extends Controller
{
    public function index()
    {
        $distributors = Distributor::with('akuns')->latest()->get();
        return view('distributor.index', compact('distributors'));
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama_perusahaan' => 'required',
            'nama_lengkap' => 'required',
            'no_hp' => 'required',
            'username' => 'required|unique:users'
        ]);

        if ($validasi->fails()) {
            if ($validasi->errors()->has('username') && $validasi->errors()->count() == 1) {
                return back()->withErrors($validasi)->withInput()->withToastError('Username sudah terdaftar, coba lagi');
            } else {
                return back()->withErrors($validasi)->withInput()->withToastError('Lengkapi semua field yang ada');
            }
        }

        // buat data distributor
        $distributor = new Distributor();
        $distributor->nama_perusahaan = $request->nama_perusahaan;
        $distributor->slug = Str::slug($request->nama_perusahaan);
        $distributor->telepon_perusahaan = $request->telepon_perusahaan;
        $distributor->pemilik_perusahaan = $request->pemilik_perusahaan;
        $distributor->lokasi_perusahaan = $request->lokasi_perusahaan;
        $distributor->save();

        // buat data biodata untuk user
        $biodata = new Biodata();
        $biodata->nama_lengkap = $request->nama_lengkap;
        $biodata->slug = Str::slug($request->nama_lengkap);
        $biodata->no_hp = $request->no_hp;
        $biodata->save();

        // buat user
        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = 'distributor';
        $user->biodata_id = $biodata->id;
        $user->save();

        // buat akun distributor
        $akunDistributor = new AkunDistributor();
        $akunDistributor->distributor_id = $distributor->id;
        $akunDistributor->user_id = $user->id;
        $akunDistributor->save();

        return to_route('distributor.index')->withToastSuccess('Data distributor ditambahkan');
    }

    public function show($slug)
    {
        $distributor = Distributor::where('slug', $slug)->first();

        return view('distributor.detail', compact('distributor'));
    }

    public function update(Request $request, $slug)
    {
        $validasi = Validator::make($request->all(), [
            'nama_perusahaan' => 'required',
        ]);

        if ($validasi->fails()) {
            return back()->withErrors($validasi)->withInput()->withToastError('Nama Perusahaan Wajib diisi');
        }

        $distributor = Distributor::where('slug', $slug)->first();

        $distributor->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'slug' => Str::slug($request->nama_perusahaan),
            'pemilik_perusahaan' => $request->pemilik_perusahaan ?? null,
            'telepon_perusahaan' => $request->telepon_perusahaan ?? null,
            'lokasi_perusahaan' => $request->lokasi_perusahaan ?? null,
        ]);

        return back()->withToastSuccess('Berhasil rubah data distributor');
    }

    public function destroy($slug)
    {
        $distributor = Distributor::where('slug', $slug)->first();
        $akunDistributor = $distributor->akuns;
        foreach ($akunDistributor as $akun) {
            $akun->user->biodata->delete();
        }
        $distributor->delete();

        return to_route('distributor.index')->withToastSuccess('Distributor berhasil dihapus');
    }
}
