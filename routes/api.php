<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * v1 Routes
 */
Route::prefix('v1')
    ->name('v1.')
    ->group(function () {

        Route::prefix('cards')
            ->name('cards.')
            ->group(base_path('routes/v1/cards.php'));

        Route::prefix('reports')
            ->name('reports.')
            ->group(base_path('routes/v1/reports.php'));

    });
