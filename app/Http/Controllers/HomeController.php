<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class HomeController extends Controller
{
    // index
    public function index() {
        return view('home');
    }

    // search user
    public function searchUser(Request $request)
    {
        $search = $request->input('search');
        $user = Member::where('nim', 'like', '%' . $search . '%')->first();

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }
    }

    // bayar tagihan sesuai username
    public function bayarTagihan($username)
    {
        $users = Member::where('username', $username)->first();

        return view('payment', compact('users'));
    }

}
