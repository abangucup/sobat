<?php

namespace App\Http\Controllers;

use App\Models\AkunDistributor;
use Illuminate\Http\Request;

class AkunDistributorController extends Controller
{
    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $akun = AkunDistributor::where('id', $id);
        $akun->user->biodata->delete();

        return redirect()->back()->withToastSuccess('Berhasil hapus akun');
    }
}
