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
    $pekanList = array_map('trim', explode(',', $request->pekan)); // Trim spasi pekan

    // Mencari member berdasarkan username
    $member = Member::where('username', $username)->first();

    // Cek apakah member ditemukan
    if (!$member) {
        Log::error('Member not found for username: ' . $username);
        return response()->json(['error' => 'Member not found'], 404);
    }

    // Memeriksa pembayaran untuk semua pekan yang diberikan
    $payments = Payment::where('username', $username)->whereIn('pekan', $pekanList)->get();

    $successfulPekans = [];
    $failedPekans = [];

    foreach ($pekanList as $pekan) {
        $pekanField = strtolower(trim($pekan)); // Make sure it's lowercase for comparison

        // Cek apakah kolom pekan ada di tabel members
        if (!Schema::hasColumn('members', $pekanField)) {
            Log::error("Pekan field not found in members table: {$pekanField}");
            $failedPekans[] = $pekan;
            continue; // Lanjutkan ke pekan berikutnya
        }

        // Cek apakah member sudah memiliki status untuk pekan tersebut
        if (!$member->$pekanField) {
            $member->$pekanField = true; // Update pekan field to true
            $member->save();
        }

        // Cari payment yang sesuai dengan pekan dan username
        $payment = Payment::where('username', $username)
                          ->where('pekan', 'LIKE', "%{$pekan}%") // Adjust for flexibility
                          ->first();

        // Jika payment tidak ditemukan
        if (!$payment) {
            Log::error("Payment not found for username: {$username} and pekan: {$pekan}");
            $failedPekans[] = $pekan;
            continue; // Lanjutkan ke pekan berikutnya
        }

        // Update status payment jika statusnya bukan 'success'
        if ($payment->status !== 'success') {
            $payment->status = 'success';
            $payment->save(); // Save the updated payment
        }

        // Catat pekan yang berhasil diproses
        $successfulPekans[] = $pekan;
    }

    // Response pekan sukses dan gagal
    return response()->json([
        'message' => "Pekan(s) updated successfully: " . implode(', ', $successfulPekans),
        'failed_pekans' => $failedPekans
    ], 200);
}

public function tolakProsesKasMember(Request $request)
{
    $username = $request->username;
    $pekanList = $request->pekan;

    // Ambil semua pembayaran yang sesuai dengan username, pekan, dan status pending
    $payments = Payment::where('username', $username)
                        ->whereIn('pekan', $pekanList)
                        ->where('status', 'pending')
                        ->get();

    // Update status pembayaran yang ditemukan menjadi failed
    Payment::where('username', $username)
        ->whereIn('pekan', $pekanList)
        ->update(['status' => 'failed']);

    // Mengembalikan respons sukses
    return response()->json([
        'message' => 'All specified pekan(s) rejected successfully.',
        'status' => 'success'
    ], 200);
}

}
