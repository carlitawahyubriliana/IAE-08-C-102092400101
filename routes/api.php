<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ProdukApiController;
// Asumsi kamu punya controller pesanan terpisah
use App\Http\Controllers\Api\PesananApiController; 

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// --- PUBLIC ROUTES (Bisa diakses tanpa login) ---
Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);

// Publik bisa melihat katalog produk
Route::get('/produk', [ProdukApiController::class, 'index']);
Route::get('/produk/{id}', [ProdukApiController::class, 'show']);


// --- PROTECTED ROUTES (Harus bawa Token API) ---
Route::middleware('auth:sanctum')->group(function () {
    
    // Logout untuk menghapus token
    Route::post('/logout', [AuthApiController::class, 'logout']);

    // Route Pesanan - Terpisah dari produk
    Route::get('/pesanan', [PesananApiController::class, 'index']);
    Route::post('/pesanan', [PesananApiController::class, 'store']);

    // Route Admin: Hanya bisa diakses oleh role admin (opsional, jika pakai middleware 'admin')
    // Route::middleware('admin')->group(function () {
        Route::post('/produk', [ProdukApiController::class, 'store']);
        Route::put('/produk/{id}', [ProdukApiController::class, 'update']);
        Route::delete('/produk/{id}', [ProdukApiController::class, 'destroy']);
    // });
});