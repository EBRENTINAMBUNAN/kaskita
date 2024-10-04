<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

Route::get('/', function () {
    return view('home');
});

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

Route::get('/admin/', function () {
    return view('admin.dashboard');
});

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
