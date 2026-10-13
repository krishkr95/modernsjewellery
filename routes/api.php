<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json([
        'brand' => 'Modern Jewellery House',
        'status' => 'operational',
        'timestamp' => now()->toIso8601String(),
    ]);
});

Route::get('/search', [SearchController::class, 'index']);
Route::post('/cart/items', [CartController::class, 'store']);
