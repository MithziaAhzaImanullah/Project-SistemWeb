<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SearchHistoryController;

// Public routes (tidak perlu login)
Route::get('/v1/destinations', [DestinationController::class, 'search']);
Route::get('/v1/destinations/{xid}', [DestinationController::class, 'detail']);
Route::get('/v1/currency/convert', [CurrencyController::class, 'convert']);

// Protected routes (wajib login)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/v1/favorites', [FavoriteController::class, 'index']);
    Route::post('/v1/favorites', [FavoriteController::class, 'store']);
    Route::delete('/v1/favorites/{id}', [FavoriteController::class, 'destroy']);

    Route::get('/v1/history', [SearchHistoryController::class, 'index']);
    Route::delete('/v1/history/{id}', [SearchHistoryController::class, 'destroy']);
});