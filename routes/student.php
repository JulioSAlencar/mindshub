<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// ❗Removido temporariamente autenticação e verificação de role
// Route::middleware(['auth', 'role:student'])->group(function () {
Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
// });

Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/profile', [StudentController::class, 'profile'])->name('student.profile');
    Route::get('/trilha', [StudentController::class, 'trilha'])->name('student.trilha');
    Route::get('/disciplinas', [StudentController::class, 'disciplinas'])->name('student.disciplinas');
    Route::get('/disciplina/{id}', [StudentController::class, 'disciplina'])->name('student.disciplina');
});
