<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermintaanController extends Controller
{
    public function index()
    {
        return view('permintaan.index');
    }

    public function permintaanOnProses()
    {
        return view('permintaan.permintaan-diproses');
    }

    public function permintaanDisetujui()
    {
        return view('permintaan.permintaan-disetujui');
    }

    public function create()
    {
        
    }

    public function destroy($id)
    {
        
    }
}
