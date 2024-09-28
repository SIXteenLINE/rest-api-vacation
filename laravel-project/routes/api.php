<?php

use App\Http\Controllers\PlaceController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index']);

// Маршруты для работы с местами отдыха
Route::get('/places', [PlaceController::class, 'index']);
Route::post('/places', [PlaceController::class, 'store']);

// Маршруты для работы со списком желаемого пользователя
Route::get('/users/{user}/wishlist', [WishlistController::class, 'index']);
Route::post('/users/{user}/wishlist', [WishlistController::class, 'store']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
