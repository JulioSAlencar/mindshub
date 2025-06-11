<?php

use App\Http\Controllers\TrackController;
use Illuminate\Support\Facades\Route;

Route::resource('/tracks', TrackController::class);
Route::get('/tracks/filter', [TrackController::class, 'filter']);
