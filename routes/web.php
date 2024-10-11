<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('login-user', [AuthController::class, 'showLoginForm'])->name('login'); // Halaman login
Route::post('login-user', [AuthController::class, 'login'])->name('login.submit'); // Proses login
Route::get('register-user', [AuthController::class, 'showRegisterForm'])->name('register'); // Halaman register
Route::post('register-user', [AuthController::class, 'register'])->name('register.submit-user'); // Proses register
Route::post('logout', [AuthController::class, 'logout'])->name('logout'); // Logout

Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::put('/data-customer/{id}', [UserController::class, 'updateprofile'])->name('user.updateProfile');
Route::delete('/user/{id}', [PaketController::class, 'destroy'])->name('user.delete');
Route::put('/user/{id}/upload-image', [UserController::class, 'uploadImage'])->name('user.upload-image');

Route::get('login-admin', [AdminAuthController::class, 'showLoginForm'])->name('login-admin');
Route::post('login-admin', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::get('register-admin', [AdminAuthController::class, 'showRegisterForm'])->name('register-admin'); // Halaman register
Route::post('register-admin', [AdminAuthController::class, 'register'])->name('register.submit-admin'); // Proses register
Route::post('logout-admin', [AdminAuthController::class, 'logout'])->name('logout-admin');

Route::get('/data-customer', [UserController::class, 'indexCustomer'])->name('data-customer');
Route::get('/decor', [PaketController::class, 'indexDecor'])->name('decor');

Route::get('dashboard', [AdminController::class, 'index'])->middleware('auth:admin')->name('index');

Route::get('/', [PaketController::class, 'indexPaket'])->name('home');
Route::get('/', [TransaksiController::class, 'indexTransaksi'])->name('home');

Route::get('/data-barang', [PaketController::class, 'index'])->name('data-barang');
Route::get('/data-barang/create', [PaketController::class, 'create'])->name('paket.create');
Route::post('/data-barang', [PaketController::class, 'store'])->name('paket.store');
Route::get('/data-barang/{pakets}', [PaketController::class, 'show'])->name('paket.show');
Route::get('/data-barang/{pakets}/edit', [PaketController::class, 'edit'])->name('paket.edit');
Route::put('/data-barang/{pakets}', [PaketController::class, 'update'])->name('paket.update');
Route::patch('/data-barang/{pakets}', [PaketController::class, 'update'])->name('paket.update');
Route::delete('/data-barang/{pakets}', [PaketController::class, 'destroy'])->name('paket.delete');

Route::post('/', [TransaksiController::class, 'store'])->name('transaksi.store');
// Route::post('/', [TransaksiController::class, 'storeItem'])->name('transaksi.item-store');
Route::post('/decor', [TransaksiController::class, 'storeDecor'])->name('transaksi.decor-store');
Route::get('/data-transaksi', [TransaksiController::class, 'index'])->name('data-transaksi');
Route::get('/data-transaksi', [PaketController::class, 'indexDatatransaksi'])->name('data-transaksi');
Route::get('/data-transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::get('/data-transaksi/{transaksi}', [TransaksiController::class, 'show'])->name('transaksi.show');
Route::get('/data-transaksi/{transaksi}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');

// Route::put('/data-transaksi/{transaksi}', [TransaksiController::class, 'update'])->name('transaksi.update');
Route::put('/profile/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
Route::patch('/profile/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');

Route::put('/account/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/account/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
Route::put('/account/{id}/upload-image', [AdminController::class, 'uploadImage'])->name('admin.upload-image');

// Route::put('/data-transaksi/{transaksi}', [TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');
Route::put('/data-transaksi/{transaksi}', [TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');
Route::patch('/data-transaksi/{transaksi}', [TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');

// Route::put('/data-transaksi', [TransaksiController::class, 'update'])->name('transaksi.update');
// Route::patch('/data-transaksi', [TransaksiController::class, 'update'])->name('transaksi.update');

Route::delete('/data-transaksi/{transaksi}', [TransaksiController::class, 'destroy'])->name('transaksi.delete');

Route::get('/decor', [PaketController::class, 'showDecor'])->name('decor');
// Route::get('/decor-single/{id}', [PaketController::class, 'showSingle'])->name('decor-single');
// Route::get('/profile', [PaketController::class, 'indexProfile'])->name('profile');
Route::get('/profile', [TransaksiController::class, 'userBookings'])->middleware('auth:web')->name('profile');
Route::get('/profile', [PaketController::class, 'indexProfile'])->middleware('auth:web')->name('profile');

// Rute untuk menampilkan form reset password
Route::get('/forgot-password-user', [UserController::class, 'showLinkRequestForm'])->name('forgot-password');
// Rute untuk menangani pengiriman form reset password
Route::post('/forgot-password-user', [UserController::class, 'sendResetPassword'])->name('password.reset');

// Rute untuk menampilkan form reset password
Route::get('/forgot-password-admin', [AdminController::class, 'showLinkRequestForm'])->name('forgot-password-admin');
// Rute untuk menangani pengiriman form reset password
Route::post('/forgot-password-admin', [AdminController::class, 'sendResetPassword'])->name('password.reset-admin');


Route::get('dashboard', function () {
    return view('admin.index');
})->name('index')->middleware('auth:admin');

Route::get('/about', function () {
    return view('user/about');
})->name('about');  // Nama route untuk 'about'

Route::get('/contact', function () {
    return view('user/contact');
})->name('contact');  // Nama route

Route::get('/services', function () {
    return view('user/services');
})->name('services');  // Nama route

// Route::get('/forgot-password-user', function () {
//     return view('user/forgot-password');
// })->name('forgot-password');  // Nama route




// Admin Pages
Route::get('/account', function () {
    return view('admin/account');
})->name('account');  // Nama route

Route::get('/notifications', function () {
    return view('admin/notifications');
})->name('notifications');  // Nama route

Route::get('/connections', function () {
    return view('admin/connections');
})->name('connections');  // Nama route
