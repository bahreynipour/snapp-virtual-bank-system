<?php

use App\Http\Controllers\Api\V1\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('top-c2c-users', [ReportController::class, 'topCardToCardUsers'])
    ->name('top-c2c-users');

