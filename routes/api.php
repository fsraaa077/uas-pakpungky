<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasirController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/menu', [KasirController::class, 'index']);
Route::post('/checkout', [KasirController::class, 'checkout']);
Route::post('/restock', [KasirController::class, 'restock']);
Route::get('/history', [KasirController::class, 'history']);
