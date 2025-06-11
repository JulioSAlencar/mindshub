<?php

use App\Http\Controllers\MissionCommentController;
use Illuminate\Support\Facades\Route;

Route::prefix('lesson-comments')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [MissionCommentController::class, 'store']);
    Route::put('/{id}', [MissionCommentController::class, 'update']);
    Route::delete('/{id}', [MissionCommentController::class, 'destroy']);
});
