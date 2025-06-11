<?php

use App\Http\Controllers\EvaluationController;
use Illuminate\Support\Facades\Route;

Route::post('/evaluations', [EvaluationController::class, 'store'])->name('evaluations.store')->middleware('auth');
