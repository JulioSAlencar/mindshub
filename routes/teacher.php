<?php

use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

// ❗Removido temporariamente autenticação e verificação de role
// Route::middleware(['auth', 'role:teacher'])->group(function () {
Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
// });

Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function () {
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/profile', [TeacherController::class, 'profile'])->name('teacher.profile');
    Route::get('/disciplinas', [TeacherController::class, 'disciplinas'])->name('teacher.disciplinas');
    Route::get('/disciplina/{id}', [TeacherController::class, 'disciplina'])->name('teacher.disciplina');
    Route::get('/criar-disciplina', [TeacherController::class, 'criarDisciplina'])->name('teacher.criarDisciplina');
});
