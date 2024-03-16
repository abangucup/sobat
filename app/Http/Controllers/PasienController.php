<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::with('biodata')->latest()->get();
        return view('pasien.index', compact('pasiens'));
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->withInput()->withToastError('Lengkapi form penginputan');
        }

        $biodata = new Biodata();
        $biodata->nama_lengkap = $request->nama_lengkap;
        $biodata->slug = Str::slug($request->nama_lengkap);
        $biodata->no_hp = $request->no_hp;
        $biodata->alamat = $request->alamat;
        $biodata->jenis_kelamin = $request->jenis_kelamin;
        $biodata->alamat = $request->alamat;
        $biodata->tanggal_lahir = $request->tanggal_lahir;
        $biodata->save();

        $pasien = new Pasien();
        $pasien->no_register = 'rsotanaha-' . substr(Str::uuid(), 0, 6);
        $pasien->biodata_id = $biodata->id;
        $pasien->save();

        return redirect()->back()->withToastSuccess('Pasine ditambahkan');
    }

    public function update(Request $request, $no_register)
    {
        $validasi = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->withInput()->withToastError('Lengkapi form penginputan');
        }

        $pasien = Pasien::where('no_register', $no_register)->first();
        $pasien->biodata->update([
            'nama_lengkap' => $request->nama_lengkap,
            'slug' => Str::slug($request->nama_lengkap),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        return redirect()->back()->withToastSuccess('Pasien Dirubah');
    }

    public function destroy($no_register)
    {
        $pasien = Pasien::where('no_register', $no_register)->first();
        if ($pasien->pemeriksaans->isNotEmpty()) {
            return redirect()->back()->withToastError('Pasien telah melakukan pemeriksaan');
        }

        $pasien->biodata->delete();

        return redirect()->back()->withToastSuccess('Pasien telah dihapus');
    }
}
