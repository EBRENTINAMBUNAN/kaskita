<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use App\Models\Payment;
use App\Models\Member;

class DashboardController extends Controller
{
    // index
    public function index()
    {
        $prosesKas = Payment::query()
        ->orderBy('username', 'asc')
        ->where('status', 'pending');

        return view('admin.dashboard', compact('prosesKas'));
    }

    public function prosesKas()
    {
        $items = Payment::query()
        ->orderBy('created_at', 'asc')
        ->where('status', 'pending')
        ->get();

        return view('admin.proses', compact('items'));
    }



    public function prosesKasMember(Request $request)
{
    $username = $request->username;
    $pekanList = explode(',', $request->pekan); 

    // Mencari member berdasarkan username
    $member = Member::where('username', $username)->first();

    // Memeriksa pembayaran untuk semua pekan yang diberikan
    $payments = Payment::whereIn('pekan', $pekanList)->where('username', $username)->get(); 

    // Cek apakah member ditemukan
    if (!$member) {
        Log::error('Member not found for username: ' . $username);
        return response()->json(['error' => 'Member not found'], 404);
    }

    // Loop melalui setiap pekan untuk melakukan pemeriksaan individu
    foreach ($pekanList as $pekan) {
        $pekanField = strtolower(trim($pekan)); 

        // Memeriksa apakah kolom pekan ada di tabel members
        if (!Schema::hasColumn('members', $pekanField)) {
            Log::error('Pekan field not found in members table: ' . $pekanField);
            return response()->json(['error' => "Field {$pekanField} not found in members table"], 400);
        }

        // Memeriksa apakah member sudah memiliki status untuk pekan tersebut
        if (!$member->$pekanField) {
            $member->$pekanField = true;
            $member->save();
        }

        // Mencari payment yang sesuai dengan pekan dan username
        $payment = $payments->firstWhere('pekan', $pekan);

        // Jika tidak ditemukan pembayaran untuk pekan ini, catat dan kembalikan pesan error
        if (!$payment) {
            Log::error('Payment not found for username: ' . $username . ' and pekan: ' . $pekan);
            return response()->json(['error' => "Payment not found for username: {$username} and pekan: {$pekan}"], 404);
        }

        // Update status pembayaran jika statusnya bukan 'success'
        if ($payment->status !== 'success') {
            $payment->status = 'success';
            $payment->save();
        }
    }

    return response()->json(['message' => "Pekan(s) updated successfully: " . implode(', ', $pekanList)], 200);
}



}
