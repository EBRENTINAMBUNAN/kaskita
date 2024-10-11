<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QrisController;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/search-user', [HomeController::class, 'searchUser'])->name('search.user');
Route::get('/payment/{username}', [HomeController::class, 'bayarTagihan'])->name('payment.show');
Route::post('/proses/payment/', [HomeController::class, 'prosesBayarTagihan'])->name('payment.proses');


Route::get('/saving', [HomeController::class, 'indexSaving'])->name('index.saving');
Route::get('/spending', [HomeController::class, 'indexSpending'])->name('index.spending');

Route::get('/search', [HomeController::class, 'indexSearch'])->name('index.search');
Route::get('/search-nim', [HomeController::class, 'searchNim'])->name('search.nim');


Route::get('/auth/login', function () {
    return view('auth.login');
});

Route::get('/admin/', [DashboardController::class, 'index'])->name('index.admin');
Route::get('/admin/proses', [DashboardController::class, 'prosesKas'])->name('index.proses');
Route::get('/admin/proses/manual', [DashboardController::class, 'indexManualKas'])->name('index.manual.proses');
Route::get('/get-pekan', [DashboardController::class, 'showData'])->name('get.pekan');
Route::post('/update-pekan', [DashboardController::class, 'updatePekan'])->name('update.pekan');




Route::post('/admin/proses-kas', [DashboardController::class, 'prosesKasMember']);
Route::post('/admin/tolak/proses-kas', [DashboardController::class, 'tolakProsesKasMember']);

Route::get('/admin/member', [MemberController::class, 'readMember'])->name('readMember');
Route::get('/admin/member/{id}', [MemberController::class, 'getMember'])->name('getMember');
Route::post('/admin/member/create', [MemberController::class, 'createMember'])->name('createMember');
Route::put('/admin/member/update/{id}', [MemberController::class, 'updateMember'])->name('updateMember');
Route::delete('/admin/member/delete/{id}', [MemberController::class, 'deleteMember'])->name('deleteMember');



Route::get('/admin/qris', [QrisController::class, 'indexQris'])->name('index.qris');
Route::post('/admin/qris/create', [QrisController::class, 'createQris'])->name('create.qris');
Route::delete('/admin/qris/{id}/delete-image', [QRISController::class, 'deleteImage'])->name('delete.qris.image');


Route::get('/admin/pengeluaran', [DashboardController::class, 'indexPengeluaran'])->name('index.pengeluaran');
Route::post('/admin/pengeluaran/create', [DashboardController::class, 'createPengeluaran'])->name('create.pengeluaran');
Route::get('/admin/pengeluaran/{id}', [DashboardController::class, 'showPengeluaran'])->name('show.pengeluaran');
Route::put('/admin/pengeluaran/update/{id}', [DashboardController::class, 'updatePengeluaran'])->name('update.pengeluaran');
Route::delete('/admin/pengeluaran/delete/{id}', [DashboardController::class, 'deletePengeluaran'])->name('delete.pengeluaran');


Route::get('/admin/pengaturan', function () {
    return view('admin.pengaturan');
});
