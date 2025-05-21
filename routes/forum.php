<?php

use App\Http\Controllers\ForumController;
use Illuminate\Support\Facades\Route;

Route::put('/forum/topic/{id}', [ForumController::class, 'updateTopic'])->name('forum.topic.update');
Route::delete('/forum/topic/{id}', [ForumController::class, 'destroyTopic'])->name('forum.topic.destroy');
Route::post('/forum/reply/{id}/toggle-constructive', [ForumController::class, 'toggleConstructive'])->name('forum.reply.toggleConstructive');
Route::put('/forum/reply/{id}', [ForumController::class, 'updateReply'])->name('forum.reply.update');
Route::delete('/forum/reply/{id}', [ForumController::class, 'destroyReply'])->name('forum.reply.destroy');
