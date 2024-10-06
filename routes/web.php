<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/search-user', [HomeController::class, 'searchUser'])->name('search.user');
Route::get('/payment/{username}', [HomeController::class, 'bayarTagihan'])->name('payment.show');
Route::post('/proses/payment/', [HomeController::class, 'prosesBayarTagihan'])->name('payment.proses');


Route::get('/saving', function () {
    return view('saving');
});

Route::get('/spending', function () {
    return view('spending');
});

Route::get('/search', function () {
    return view('search');
});

Route::get('/auth/login', function () {
    return view('auth.login');
});

Route::get('/admin/', [DashboardController::class, 'index'])->name('index');
Route::get('/admin/proses', [DashboardController::class, 'prosesKas'])->name('index.proses');

Route::get('/admin/member', [MemberController::class, 'readMember'])->name('readMember');
Route::get('/admin/member/{id}', [MemberController::class, 'getMember'])->name('getMember');
Route::post('/admin/member/create', [MemberController::class, 'createMember'])->name('createMember');
Route::put('/admin/member/update/{id}', [MemberController::class, 'updateMember'])->name('updateMember');
Route::delete('/admin/member/delete/{id}', [MemberController::class, 'deleteMember'])->name('deleteMember');



Route::get('/admin/tagihan', function () {
    return view('admin.tagihan');
});

Route::get('/admin/pengeluaran', function () {
    return view('admin.pengeluaran');
});
Route::get('/admin/pengaturan', function () {
    return view('admin.pengaturan');
});
