<?php

use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;

Route::post('/feedbacks', [FeedbackController::class, 'store']);
Route::get('/feedbacks/student/{id}', [FeedbackController::class, 'showByStudent']);
