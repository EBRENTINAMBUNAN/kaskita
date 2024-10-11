<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Qris;

class QrisController extends Controller
{
    //method untuk menampilkan halaman
    public function indexQris()
    {
        $qris = Qris::query()->first();

        $qrisCount = Qris::count();

        return view('admin.qris', compact('qris', 'qrisCount'));
    }

    //method untuk mengupload qris
    public function createQris(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:50',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Pengecekan apakah jumlah record QRIS sudah lebih dari 1
    $qrisCount = Qris::count();
    
    if ($qrisCount >= 1) {
        return back()->withErrors(['qris' => 'Data QRIS sudah ada lebih dari 1. Tidak bisa menambahkan lagi.']);
    }

    // Lanjutkan proses upload gambar jika belum ada lebih dari 1 record
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('assets/img/uploads/admin'), $imageName);
    } else {
        return back()->withErrors(['image' => 'Gagal mengunggah gambar. Silakan coba lagi.']);
    }  

    // Insert data ke database
    Qris::create([
        'name' => $validatedData['name'],
        'image' => $imageName,
    ]);

    return redirect()->route('index.qris')->with('success', 'Pembayaran berhasil diajukan, dan sedang dalam proses.');
}


    // method untuk menghapus
    public function deleteImage($id)
    {
        $qris = QRIS::find($id);
    
        if ($qris && !empty($qris->image)) {
            $imagePath = public_path('assets/img/uploads/admin/' . $qris->image);
            
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $qris->delete();
            return redirect()->back()->with('success', 'QRIS dan gambar berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'QRIS tidak ditemukan atau tidak memiliki gambar.');
    }
    
}
