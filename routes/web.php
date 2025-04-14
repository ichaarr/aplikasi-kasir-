<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PenjualanController;


Route::get('/', function () {
    return view('welcome');
});


// Routes untuk resource pelanggan
Route::resource('pelanggans', PelangganController::class);
Route::get('pelanggans2', 'PelangganController@index2')->name('pelanggans2.index');
// Route::get('pelanggans2/create', 'PelangganController@create2')->name('pelanggans2.create');
// Route::get('pelanggans2/{id}/edit', 'PelangganController@edit2')->name('pelanggans2.edit');
// Route::get('pelanggans2/{id}', 'PelangganController@destroy2')->name('pelanggans2.destroy');





Route::get('penjualans', [PenjualanController::class, 'index'])->name('penjualans.index');
Route::get('penjualans/create', [PenjualanController::class, 'create'])->name('penjualans.create');
Route::get('penjualans/{id}/edit', [PenjualanController::class, 'edit'])->name('penjualans.edit');
Route::put('penjualans/{id}', [PenjualanController::class, 'update'])->name('penjualans.update');
Route::delete('penjualans/{id}', [PenjualanController::class, 'destroy'])->name('penjualans.destroy');
Route::post('penjualans', [PenjualanController::class, 'store'])->name('penjualans.store');

Route::get('penjualans2', 'PenjualanController@index2')->name('penjualans2.index');

Route::resource('produks', ProdukController::class);
Route::get('produks2', 'ProdukController@index2')->name('produks2.index');

// Route::resource('detailpenjualans', DetailPenjualanController::class);

Route::resource('kategoris', KategoriController::class);

Route::resource('pembayarans', PembayaranController::class);
// routes/web.php
Route::get('pembayarans/{id}/edit', [PembayaranController::class, 'edit'])->name('pembayarans.edit');


Route::resource('stokmasuks', StokMasukController::class);


Route::get('/Dashboard', [DashboardController::class, 'index'])->name('Dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Route::get('/pembayarans', [PembayaranController::class, 'index'])->name('pembayarans.index');
// Route::get('pembayaran/create/{penjualanId}', [PembayaranController::class, 'create'])->name('pembayarans.create');
// Route::post('/pembayarans/{penjualan}', [PembayaranController::class, 'store'])->name('pembayarans.store');
Route::get('/penjualans/{id}', [PenjualanController::class, 'show'])->name('penjualans.show');

Route::get('/pembayarans', [PembayaranController::class, 'index'])->name('pembayarans.index');
Route::get('pembayaran/create/{penjualanId}', [PembayaranController::class, 'create'])->name('pembayarans.create');
// Route untuk menyimpan data pembayaran
Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
Route::get('pembayaran/create/{penjualanId}', [PembayaranController::class, 'create'])->name('pembayarans.create');

// Route::get('pembayaran/create/{id}', [PembayaranController::class, 'create'])->name('pembayaran.create');
// Route::post('pembayaran/store', [PembayaranController::class, 'store'])->name('pembayaran.store');
// Route::get('pembayaran/{id}/edit', [PembayaranController::class, 'edit'])->name('pembayaran.edit');
// Route::put('pembayaran/{id}', [PembayaranController::class, 'update'])->name('pembayaran.update');
// Route::delete('pembayaran/{id}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');


Route::get('penjualans/{id}', [PenjualanController::class, 'show'])->name('penjualans.show');

use App\Http\Controllers\PdfController;

Route::get('/generate-pdf', [PdfController::class, 'generatePdf'])->name('generate.pdf');


Route::get('/penjualan/{id}/detail', [PenjualanController::class, 'detail'])->name('penjualan.detail');
Route::get('/penjualan/{id}/cetak-pdf', [PenjualanController::class, 'cetakPdf'])->name('penjualan.cetak-pdf');

Route::get('penjualans/{PenjualanID}/cetak', [PenjualanController::class, 'cetak'])->name('penjualans.cetak');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

use App\Http\Controllers\Auth\LoginController;

// Menampilkan form login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Proses login
Route::post('/login', [LoginController::class, 'login']);

// // Proses logout
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;

Auth::routes(); // Menggunakan route default Laravel untuk autentikasi

// Alternatif jika ingin mendefinisikan route manual untuk registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);




Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login'); // Redirect ke halaman login setelah logout
})->name('logout');


Route::post('/admin/tambah-user', [AdminController::class, 'storeUser'])->name('admin.store_user');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/kasir/dashboard', [KasirController::class, 'index'])->name('kasir.dashboard');
});


use App\Http\Controllers\LaporanController;

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::post('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');


