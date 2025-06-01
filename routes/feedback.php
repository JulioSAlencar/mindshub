<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MissionFeedbackController;
use Illuminate\Support\Facades\Route;

Route::post('/feedbacks', [FeedbackController::class, 'store']);
Route::get('/feedbacks/student/{id}', [FeedbackController::class, 'showByStudent']);

Route::post('/mission-feedback', [MissionFeedbackController::class, 'store'])->name('feedback.store')->middleware('auth');

