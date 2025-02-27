<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Models\Payment;
use App\Models\Member;
use App\Models\Spending;

class DashboardController extends Controller
{
    public function index()
{
    // method untuk menampilkan dashboard utama
    $prosesKas = Payment::where('status', 'pending')
                        ->orderBy('username', 'asc')
                        ->get();

    $members = Member::all();

    $totalKas = 0;
    foreach ($members as $member) {
        for ($i = 1; $i <= 16; $i++) {
            $field = "p" . $i;
            if ($member->$field == 1) {
                $totalKas += 5000;
            }
        }
    }
    
    $totalSpending = Spending::sum('amount');

    $hasilKas = $totalKas - $totalSpending;

    $payments = Payment::where('status', 'success')->sum('amount');

    $historys = Payment::query()
                        ->orderBy('id', 'desc')
                        ->take(3)
                        ->get();

    $hispends = Spending::query()
                        ->orderBy('id', 'desc')
                        ->take(3)
                        ->get();

    return view('admin.dashboard', compact('prosesKas', 'totalKas', 'members', 'totalSpending', 'hasilKas', 'payments', 
'historys', 'hispends'));
}



    // Method untuk menampilkan halaman proses kas manual
    public function indexManualKas(Request $request)
    {   
        $members = Member::all();
        return view('admin.proses_manual', compact('members'));
    }

    // method untuk menampilkan nilai 
    public function showData(Request $request)
    {
        $member = Member::where('username', $request->username)->first();

        if ($member) {
            $filteredData = collect([
                'p1' => $member->p1,
                'p2' => $member->p2,
                'p3' => $member->p3,
                'p4' => $member->p4,
                'p5' => $member->p5,
                'p6' => $member->p6,
                'p7' => $member->p7,
                'p8' => $member->p8,
                'p9' => $member->p9,
                'p10' => $member->p10,
                'p11' => $member->p11,
                'p12' => $member->p12,
                'p13' => $member->p13,
                'p14' => $member->p14,
                'p15' => $member->p15,
                'p16' => $member->p16
            ])->filter(function ($value) {
                return $value == 0;
            });
            return response()->json($filteredData);
        }
        return response()->json([], 404); 
    }


    // method untuk ubah status coloum menjadi true 
    public function updatePekan(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'pekan' => 'required|string',
        ]);

        $member = Member::where('username', $request->username)->first();

        if ($member) 
        {
            $nim = $member->nim;
            $type = 'offline';

            $pekanColumn = $request->pekan;

            if (in_array($pekanColumn, ['p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8', 'p9', 'p10', 'p11', 'p12', 'p13', 'p14', 'p15', 'p16'])) {
                $member->$pekanColumn = 1;
                $member->save();

                Payment::create([
                    'username' => $member->username,
                    'nim' => $nim,
                    'type' => $type,
                    'pekan' => $pekanColumn,
                    'amount' => '5000',
                    'status' => 'success',
                    'image' => 'cash.jpg',
                ]);

                $pesan = "Selamat, pembayaran telah lunas.\n" .
                         "============================\n\n" .
                         "Username: $member->username\n" .
                         "NIM: $nim\n" .
                         "type: $type\n" .
                         "Pekan: $request->pekan\n\n" .
                         "Kamu bisa cek status pembayaran lewat link berikut:\n" .
                         route('index.search');

                $response = Http::withHeaders([
                    'Authorization' => '', // isi dengan code fonte mu
                ])->asForm()->post('https://api.fonnte.com/send', [
                    'target' => $member->wa,
                    'message' => $pesan,
                ]);


                return response()->json([
                    'message' => 'Data berhasil diperbarui dan pembayaran dicatat'
                ], 200);
            }
            return response()->json(['message' => 'Kolom pekan tidak valid'], 400);
        }

        return response()->json(['message' => 'Member tidak ditemukan'], 404);
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

        $nim = $member->nim;
        $type = 'online';

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

        $pesan = "Selamat, pembayaran telah lunas.\n" .
                "============================\n\n" .
                "Username: $member->username\n" .
                "NIM: $nim\n" .
                "Type: $type\n" .
                "Pekan: $request->pekan\n\n" .
                "Kamu bisa cek status pembayaran lewat link berikut:\n" .
                route('index.search'); 

        try {
            $response = Http::withHeaders([
                'Authorization' => '', //isi dengan code fonte mu 
            ])->asForm()->post('https://api.fonnte.com/send', [
                'target' => $member->wa,
                'message' => $pesan,
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim pesan ke ' . $member->username . ': ' . $e->getMessage());
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

            $member = Member::where('username', $validatedData['username'])->first();
            
            if (!$member) {
                return response()->json([
                    'result' => false,
                    'message' => 'Member tidak ditemukan.'
                ], 404);
            }

            $nim = $member->nim;
            $type = 'online';

            $pesan = "Hallo, $member->username\n" .
                    "============================\n\n" .
                    "Pembayaran kamu gagal nih... \n" .
                    "Type: $type\n" .
                    "Pekan: $request->pekan\n\n" .
                    "Silahkan hubungi admin untuk info lebih lanjut.\n";

            try {
                $response = Http::withHeaders([
                    'Authorization' => '', //isi dengan code fonte mu 
                ])->asForm()->post('https://api.fonnte.com/send', [
                    'target' => $member->wa,
                    'message' => $pesan,
                ]);

            } catch (\Exception $e) {
                Log::error('Gagal mengirim pesan ke ' . $member->username . ': ' . $e->getMessage());
            }

            // Respon sukses
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


    // method untuk menampilkan data dari model spending ke dalam tabel
    public function indexPengeluaran()
    {
        $spendings = Spending::query()->orderBy('id', 'desc')->get();

        return view('admin/pengeluaran', compact('spendings'));
    }
    
    //method untuk insert data baru 
    public function createpengeluaran(Request $request)
    {
        $validate = $request->validate([
            'deskripsi' => 'required|string|max:255',  
            'amount' => 'required|numeric',  
        ]);

        Spending::create([
            'deskripsi' => $validate['deskripsi'],
            'amount' => $validate['amount'],
        ]);

        return redirect()->route('index.pengeluaran')->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    //method untuk mencari data berdasarkan id yang dipilih 
    public function showPengeluaran($id)
    {
        $spending = Spending::find($id);
        return response()->json($spending);
    }

    //method untuk update data berdasarkan id yang dipilih 
    public function updatePengeluaran(Request $request, $id)
    {
        $spending = Spending::find($id);
        $spending->deskripsi = $request->input('deskripsi');
        $spending->amount = $request->input('amount');
        $spending->save();

        return redirect()->back()->with('success', 'Spending updated successfully');
    }

    // method untuk menghapus data berdasarkan id yang dipilih
    public function deletePengeluaran($id)
    {
        $pengeluaran = Spending::findOrFail($id);
        $pengeluaran->delete();

        return redirect()->back()->with('success', 'Spending updated successfully');
    }



}
