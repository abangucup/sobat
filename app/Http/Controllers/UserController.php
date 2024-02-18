<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('akunDistributor')->latest()->get();
        return view('user.index', compact('users'));
    }

    public function destroy(User $id)
    {
        dd($id);
    }
}
