<?php

use App\Http\Controllers\PerformanceController;
use Illuminate\Support\Facades\Route;

Route::post('/performances', [PerformanceController::class, 'store']);
