<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class AuthController extends Controller
{
    // method menampilkan halaman login
    public function indexLogin() 
    {
        if (Auth::check()) {
            return redirect('/admin');
        }

        return view('auth.login');
    }

    // method proses login
    public function prosesLogin(Request $request) 
    {
        $credentials = $request->validate([
            'name' => 'required|string|min:5',
            'password' => 'required|string|min:8',
        ]);
        $remember = $request->filled('remember'); 

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate(); 
            return redirect()->intended('/admin'); 
        }
        return back()->withErrors([
            'loginError' => 'Username atau password yang kamu masukan salah !',
        ]);
    }

    // Method untuk logout
    public function logout(Request $request)
    {
        Auth::logout();

        // Hapus semua session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect()->route('index.login')->with('success', 'You have been logged out successfully.');
    }


    // Menampilkan form lupa password
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Mengirimkan link reset password melalui WhatsApp menggunakan Foonte
    public function sendResetPassword(Request $request)
    {
        $request->validate([
            'wa' => 'required|numeric|min:10',
        ]);
    
        $user = User::where('wa', $request->wa)->first();
    
        if (!$user) {
            return back()->withErrors(['error' => 'Nomor WhatsApp tidak ditemukan.']);
        }
    
        $token = Str::random(60);
        $expiresAt = now()->addHour();
    
        $user->reset_token = $token;
        $user->token_expires_at = $expiresAt;
        $user->save();
    
        $resetLink = route('reset.password', ['token' => $token, 'wa' => $request->wa]);
    
        $pesan = "Silakan klik link berikut untuk mengubah password Anda: " . $resetLink;
    
        $response = Http::withHeaders([
            'Authorization' => 'mbynff#JsZs_ig7vAXc-', 
        ])->asForm()->post('https://api.fonnte.com/send', [
            'target' => $request->wa,
            'message' => $pesan,
        ]);
    
        if ($response->successful()) {
            return redirect()->route('index.login')->with('success', 'Link reset password berhasil dikirim!');
        } else {
            return back()->withErrors(['error' => 'Gagal mengirim link reset password. Silakan coba lagi.']);
        }
    }

    // method menampilkan halaman reset password
    public function showResetPasswordForm(Request $request)
    {
        $token = $request->query('token');
        $wa = $request->query('wa');

        $user = User::where('reset_token', $token)
            ->where('wa', $wa)
            ->where('token_expires_at', '>=', now())
            ->first();

        if (!$user) {
            return redirect()->route('index.login')->withErrors(['error' => 'Link tidak valid atau sudah kadaluarsa.']);
        }

        return view('auth.reset-password', ['token' => $token, 'wa' => $wa]);
    }

    // method ubah password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required|string',
            'wa' => 'required|string',
        ]);

        $user = User::where('reset_token', $request->token)
            ->where('wa', $request->wa)
            ->where('token_expires_at', '>=', now())
            ->first();

        if (!$user) {
            return redirect()->route('index.login')->withErrors(['error' => 'Link tidak valid atau sudah kadaluarsa.']);
        }

        $user->password = Hash::make($request->password);
        $user->reset_token = null; 
        $user->token_expires_at = null; 
        $user->save();

        return redirect()->route('index.login')->with('success', 'Password berhasil direset.');
    }

}
