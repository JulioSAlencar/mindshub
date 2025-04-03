<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/escolhaUsuario', function () {
    return view('users.escolha-usuario');
})->name('escolhaUsuario.page');

Route::get('/register/teacher', function () {
    return view('users.register-teacher'); // Certifique-se de que a view existe
})->name('register.teacher');

Route::get('/register/student', function () {
    return view('users.register-student'); // Certifique-se de que a view existe
})->name('register.student');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Agrupamento de rotas autenticadas
Route::middleware('auth')->group(function () {
    require __DIR__ . '/profile.php';
    require __DIR__ . '/student.php';
    require __DIR__ . '/teacher.php';
});

// Importa rotas de autenticação
require __DIR__ . '/auth.php';
