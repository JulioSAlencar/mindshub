<?php

use App\Http\Controllers\ProgressController;
use Illuminate\Support\Facades\Route;

Route::post('/progress/{trackId}', [ProgressController::class, 'update']);
