<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $role = Auth::user()->role;

        if ($role == 'distributor') {
            return view('dashboard.distributor');
        } elseif ($role == 'gudang') {
            return view('dashboard.gudang');
        } elseif ($role == 'pelayanan') {
            return view('dashboard.pelayanan');
        } elseif ($role == 'depo') {
            return view('dashboard.depo');
        } elseif ($role == 'ppk') {
            return view('dashboard.ppk');
        } elseif ($role == 'direktur') {
            return view('dashboard.direktur');
        } elseif ($role == 'poli') {
            return view('dashboard.poli');
        } else {
            Auth::logout();
            return redirect('login')->withToastInfo('Anda terindikasi penyusup');
        }
    }
}
