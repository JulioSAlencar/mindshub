<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ❗Removido temporariamente o middleware 'auth' para facilitar testes no front
// Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
