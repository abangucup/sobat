<?php

namespace App\Http\Controllers;

use App\Models\AkunDistributor;
use App\Models\Biodata;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'distributor') {
            $distributor = $user->akunDistributor->distributor_id;
            $users = User::with('biodata', 'akunDistributor', 'akunDistributor.distributor')->whereHas('akunDistributor', function ($query) use ($distributor) {
                $query->where('distributor_id', $distributor);
            })->latest()->get();
        } else {
            $users = User::with('biodata', 'akunDistributor', 'akunDistributor.distributor')->latest()->get();
        }

        return view('user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
        ]);

        if ($validasi->fails()) {
            if ($validasi->errors()->has('username') && $validasi->errors()->count() == 1) {
                return back()->withErrors($validasi)
                    ->withInput()
                    ->withToastError('Username sudah terdaftar, coba lagi');
            } else {
                return back()->withErrors($validasi)
                    ->withInput()
                    ->withToastError('Lengkapi semua field yang ada');
            }
        }

        $role = Auth::user()->role;

        $biodata = new Biodata();
        $biodata->nama_lengkap = $request->nama_lengkap;
        $biodata->slug = Str::slug($request->nama_lengkap);
        $biodata->jenis_kelamin = $request->jenis_kelamin;
        $biodata->tanggal_lahir = $request->tanggal_lahir;
        $biodata->no_hp = $request->no_hp;
        $biodata->alamat = $request->alamat ?? '';
        $biodata->save();

        $user = new User();
        $user->biodata_id = $biodata->id;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->email = $request->email ?? null;
        if ($role == 'distributor') {
            $user->role = 'distributor';
        } elseif ($role == 'gudang') {
            $user->role = $request->role;
        } elseif ($role == 'pelayanan') {
            $user->role = 'pelayanan';
        } elseif ($role == 'depo') {
            $user->role = 'depo';
        } elseif ($role == 'poli') {
            $user->role = 'poli';
        } else {
            return redirect()->back()->withToastError('anda melanggar');
        }
        $user->save();

        if ($role == 'distributor') {
            $distributor = Auth::user()->akunDistributor->distributor_id;

            $akunDistributor = new AkunDistributor();
            $akunDistributor->distributor_id = $distributor;
            $akunDistributor->user_id = $user->id;
            $akunDistributor->save();
        }

        return redirect()->back()->withToastSuccess('Berhasil tambah data user');
    }

    public function update(Request $request, User $user)
    {
        $validasi = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required',
            'username' => 'required|unique:users,username,' . $user->id, // pengecualian untuk username yang sekarang
        ]);
        if ($validasi->fails()) {
            if ($validasi->errors()->has('username') && $validasi->errors()->count() == 1) {
                return back()->withErrors($validasi)
                    ->withInput()
                    ->withToastError('Username sudah terdaftar, coba lagi');
            } else {
                return back()->withErrors($validasi)
                    ->withInput()
                    ->withToastError('Lengkapi semua field yang ada');
            }
        }

        // Cek ROle yang melakukan update
        $role = Auth::user()->role;

        // update biodata
        $user->biodata->update([
            'nama_lengkap' => $request->nama_lengkap,
            'slug' => Str::slug($request->nama_lengkap),
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat ?? '',
        ]);

        // upadate user
        $user->username = $request->username;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email ?? null;
        if ($role == 'distributor') {
            $user->role = 'distributor';
        } elseif ($role == 'gudang') {
            $user->role = $request->role;
        } elseif ($role == 'pelayanan') {
            $user->role = 'pelayanan';
        } elseif ($role == 'depo') {
            $user->role = 'depo';
        } elseif ($role == 'poli') {
            $user->role = 'poli';
        } else {
            return redirect()->back()->withToastError('anda melanggar');
        }
        $user->save();

        return redirect()->back()->withToastSuccess('User berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->biodata->delete();

        return to_route('user.index')->withToastSuccess('User dihapus');
    }
}
