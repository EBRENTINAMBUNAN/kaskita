<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PengaturanController extends Controller
{
    //method menampilkan halaman pengaturan
    public function indexPengaturan()
    {
        $users = User::query()->first();

        return view('admin.pengaturan', compact('users'));
    }
    
    //method mengubah profile
    public function changeProfile(Request $request)
    {
        $validate = $request->validate([
            'wa' => 'required|string|min:10',
        ]);

        $username = $request['username'];

        $users = User::where('name', $username)->first();

        if (!$users) {
            return back()->withErrors(['error' => 'user tidak di temukan']);
        }   else {
            $users->wa = $validate['wa'];
            $users->save();
        }

        return redirect()->route('index.pengaturan')->with('success', 'whatsapp berhasil di perbarui');
    }

    // Method untuk mengubah password
    public function changePassword(Request $request)
    {
        $validate = $request->validate([
            'password' => 'required|string|max:255', 
            'password1' => 'required|string|max:255', 
            'password2' => 'required|string|max:255|same:password1', 
        ]);

        $user = User::where('name', $request->username)->first();

        if (!$user) {
            return back()->withErrors(['error' => 'User tidak ditemukan']);
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['error' => 'Password saat ini tidak sesuai']);
        }

        $user->password = Hash::make($request->password1);
        $user->save();

        return redirect()->route('index.pengaturan')->with('success', 'Password berhasil diubah');
    }

}
