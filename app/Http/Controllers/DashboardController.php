<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Payment;
use App\Models\Member;

class DashboardController extends Controller
{
    // Method untuk menampilkan dashboard utama
    public function index()
    {
        $prosesKas = Payment::where('status', 'pending')
                            ->orderBy('username', 'asc')
                            ->get();

        return view('admin.dashboard', compact('prosesKas'));
    }

    // Method untuk menampilkan halaman proses kas
    public function prosesKas()
    {
        $items = Payment::where('status', 'pending')
                        ->orderBy('created_at', 'asc')
                        ->get();

        return view('admin.proses', compact('items'));
    }

    // Method untuk memproses kas member
    public function prosesKasMember(Request $request)
    {
        $username = $request->username;
        $pekanList = array_map('trim', explode(',', $request->pekan));

        $member = Member::where('username', $username)->first();
        
        if (!$member) {
            return response()->json(['error' => 'Member not found'], 404);
        }

        $payments = Payment::where('username', $username)
                           ->whereIn('pekan', $pekanList)
                           ->where('status', 'pending')
                           ->get();

        $successfulPekans = [];
        $failedPekans = [];

        foreach ($pekanList as $pekan) {
            $pekanField = strtolower(trim($pekan));

            if (!Schema::hasColumn('members', $pekanField)) {
                $failedPekans[] = $pekan;
                continue;
            }

            if (!$member->$pekanField) {
                $member->$pekanField = true;
                $member->save();
            }

            $payment = Payment::where('username', $username)
                              ->where('pekan', 'LIKE', "%$pekan%")
                              ->where('status', 'pending')
                              ->first();

            if (!$payment) {
                $failedPekans[] = $pekan;
                continue;
            }

            if ($payment->status !== 'success') {
                $payment->status = 'success';
                $payment->save();
            }

            $successfulPekans[] = $pekan;
        }

        return response()->json([
            'message' => 'Pekan(s) updated successfully: ' . implode(', ', $successfulPekans),
            'failed_pekans' => $failedPekans
        ], 200);
    }

    // Method untuk menolak proses kas member
    public function tolakProsesKasMember(Request $request)
{
    $validatedData = $request->validate([
        'username' => 'required|string',
        'pekan' => 'required|string'
    ]);

    $payment = Payment::where('username', $validatedData['username'])
                      ->where('pekan', $validatedData['pekan'])
                      ->where('status', 'pending')
                      ->first();

    if ($payment) {
        $payment->status = 'failed';
        $payment->save();

        return response()->json([
            'result' => true,
            'message' => 'Status pembayaran berhasil diubah menjadi failed.'
        ]);
    } else {
        return response()->json([
            'result' => false,
            'message' => 'Data pembayaran tidak ditemukan.'
        ], 404);
    }
}

}
