<?php

use App\Http\Controllers\TrailController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/trilha', [TrailController::class, 'index'])->name('trails.show');
});