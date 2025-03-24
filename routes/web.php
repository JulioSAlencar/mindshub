<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

<<<<<<< Updated upstream
// Rotas para alunos
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
});

// Rotas para professores
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
=======
// Rotas para estudantes
Route::prefix('student')->middleware(['auth', 'role:student'])->group(function () {
    Route::get('/', [StudentController::class, 'dashboard'])->name('student.dashboard');

});

// Rotas para professores
Route::prefix('teacher')->middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/disciplines', [TeacherController::class, 'disciplines'])->name('teacher.disciplines');
>>>>>>> Stashed changes
});


require __DIR__.'/auth.php';
