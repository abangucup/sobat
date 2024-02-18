<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $kredensial = $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($kredensial)) {
            $role = Auth::user()->role;
            return redirect('dashboard')->withToastSuccess('Anda berhasil login sebagai ' . $role);
        }
        return to_route('login')->withErrors($kredensial)->withInput($kredensial)->withToastError('Username atau password salah');
    }
}
