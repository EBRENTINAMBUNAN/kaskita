<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

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
        ->orderBy('username', 'asc')
        ->where('status', 'pending')
        ->get();

        return view('admin.proses', compact('items'));
    }
}
