<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Payment;

class HomeController extends Controller
{
    // index
    public function index() {
        return view('home');
    }

    // search user
    public function searchUser(Request $request)
    {
        $validatedData = $request->validate([
            'search' => 'required|string|max:50',
        ]);

        $search = $validatedData['search'];
        

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

        if (!isset($users)) {
            return "Data tidak ditemukan";
        } else {
            session(['username' => $username]);
            return view('payment', compact('users'));
        }
    }

    // kirim pembayaran
    public function prosesBayarTagihan(Request $request) 
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:50',
            'nim' => 'required|string|max:20',
            'pekan' => 'required|string|max:100',
            'amount' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $existingPayment = Payment::where('pekan', $validatedData['pekan'])
            ->where(function ($query) use ($validatedData) {
                $query->where('username', $validatedData['username'])
                    ->orWhere('nim', $validatedData['nim']);
            })
            ->where('status', 'pending')
            ->first();

            $username = $request->username;

        if ($existingPayment) {
            return back()->withErrors([
                'pekan' => 'Hallo ' . $username .' pembayaran untuk pekan yang dipilih, masih dalam proses.'
            ])->withInput();
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('assets/img/uploads'), $imageName);
        } else {
            return back()->withErrors(['image' => 'Gagal mengunggah gambar. Silakan coba lagi.']);
        }        

        Payment::create([
            'username' => $validatedData['username'],
            'nim' => $validatedData['nim'],
            'type' => 'online',
            'pekan' => $validatedData['pekan'],
            'amount' => $validatedData['amount'],
            'image' => $imageName,
            'status' => 'pending', 
        ]);

        return redirect()->route('index')->with('success', 'Pembayaran berhasil diajukan, dan sedang dalam proses.');
    }
}
