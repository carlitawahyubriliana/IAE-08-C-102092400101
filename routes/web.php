<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public Routes
// Route::get('/', function () {
//     return view('index');
// })->name('home');

Route::get('/', function () {
    return view('homepage');
})->name('home');

// Auth Routes (Guest Only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

// Logout Route (Authenticated Users)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Public Pages Routes
Route::get('/produk', [\App\Http\Controllers\Customer\ProdukController::class, 'index'])->name('produk.index');
Route::get('/tentang-kami', function () {
    return view('tentang-kami');
})->name('tentang-kami');
Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

// Public Product Route
Route::get('/produk/{id}', [\App\Http\Controllers\Customer\ProdukController::class, 'show'])->name('produk.show');

// Customer Routes (Authenticated Users)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('customer.dashboard');
    
    // Keranjang
    Route::get('/keranjang', [\App\Http\Controllers\Customer\KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/tambah', [\App\Http\Controllers\Customer\KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::put('/keranjang/{key}', [\App\Http\Controllers\Customer\KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/{key}', [\App\Http\Controllers\Customer\KeranjangController::class, 'hapus'])->name('keranjang.hapus');
    
    // Checkout
    Route::get('/checkout', [\App\Http\Controllers\Customer\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/proses', [\App\Http\Controllers\Customer\CheckoutController::class, 'proses'])->name('checkout.proses');
    
    // Pesanan Customer
    Route::get('/pesanan', [\App\Http\Controllers\Customer\PesananController::class, 'index'])->name('customer.pesanan.index');
    Route::get('/pesanan/{id}', [\App\Http\Controllers\Customer\PesananController::class, 'show'])->name('customer.pesanan.show');
});

// Admin Routes (Admin Only)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    // Kelola Produk
    Route::resource('produk', \App\Http\Controllers\Admin\ProdukController::class)->names([
        'index' => 'admin.produk.index',
        'create' => 'admin.produk.create',
        'store' => 'admin.produk.store',
        'show' => 'admin.produk.show',
        'edit' => 'admin.produk.edit',
        'update' => 'admin.produk.update',
        'destroy' => 'admin.produk.destroy',
    ]);
    
    // Kelola Pesanan
    Route::resource('pesanan', \App\Http\Controllers\Admin\PesananController::class)->names([
        'index' => 'admin.pesanan.index',
        'show' => 'admin.pesanan.show',
        'destroy' => 'admin.pesanan.destroy',
    ])->only(['index', 'show', 'destroy']);
    
    // Update Status Pesanan
    Route::post('pesanan/{id}/update-status', [\App\Http\Controllers\Admin\PesananController::class, 'updateStatus'])
        ->name('admin.pesanan.updateStatus');
    Route::post('pesanan/{id}/update-pembayaran', [\App\Http\Controllers\Admin\PesananController::class, 'updatePembayaran'])
        ->name('admin.pesanan.updatePembayaran');
    
    // Kelola Customer
    Route::resource('customer', \App\Http\Controllers\Admin\CustomerController::class)->names([
        'index' => 'admin.customer.index',
        'show' => 'admin.customer.show',
        'destroy' => 'admin.customer.destroy',
    ])->only(['index', 'show', 'destroy']);
    
    // Laporan
    Route::get('laporan', [\App\Http\Controllers\Admin\LaporanController::class, 'index'])
        ->name('admin.laporan.index');
});
