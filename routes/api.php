<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ProdukApiController;
use App\Http\Controllers\Api\PesananApiController; 

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);

Route::get('/produk', [ProdukApiController::class, 'index']);
Route::get('/produk/{id}', [ProdukApiController::class, 'show']);


Route::middleware('auth:sanctum')->group(function () {
    
    
    Route::post('/logout', [AuthApiController::class, 'logout']);

    Route::get('/pesanan', [PesananApiController::class, 'index']);
    Route::post('/pesanan', [PesananApiController::class, 'store']);

    Route::post('/produk', [ProdukApiController::class, 'store']);
    Route::put('/produk/{id}', [ProdukApiController::class, 'update']);
    Route::delete('/produk/{id}', [ProdukApiController::class, 'destroy']);
});