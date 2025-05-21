<?php

use App\Http\Controllers\TrailController;
use Illuminate\Support\Facades\Route;

Route::get('/trails', [TrailController::class, 'show'])->name('trails.show');
Route::get('/trails/{id}/average-progress', [TrailController::class, 'averageProgress']);
Route::post('/trails/{trail}/check-completion', [TrailController::class, 'checkCompletion'])->name('trails.checkCompletion');
