<?php

use App\Http\Controllers\Auth\TypeUserController as AuthTypeUserController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/escolha', function () {
    return view('users.escolha-usuario');
});

Route::get('/home', function () {
    return view('users.home');
});

// Termos de uso
Route::get('/termos', function () {
    return view('TermsOfUse');
})->name('termos');

// Página principal e outras visões
Route::get('/disciplines/page', [DisciplineController::class, 'index'])->name('disciplines.page'); // Página principal
Route::get('/disciplines/content/{id}', [DisciplineController::class, 'content'])->name('disciplines.content'); // Conteúdo

// CRUD
Route::get('/disciplines/create', [DisciplineController::class, 'create'])->name('disciplines.create');
Route::post('/disciplines', [DisciplineController::class, 'store']);

Route::get('/disciplines/{id}', [DisciplineController::class, 'show'])->name('disciplines.show');
Route::post('/disciplines/join/{id}', [DisciplineController::class, 'joinDiscipline'])->name('disciplines.join');
Route::get('/disciplines/edit/{id}', [DisciplineController::class, 'edit'])->name('disciplines.edit');
Route::put('/disciplines/update/{id}', [DisciplineController::class, 'update'])->name('disciplines.update');
Route::delete('/disciplines/{id}', [DisciplineController::class, 'destroy'])->name('disciplines.destroy');



Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    // ->middleware(['auth', 'verified']) // descomente quando for para produção
    ->name('dashboard');

// ❌ Middleware 'auth' desativado temporariamente
// Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::prefix(['middleware' => ['auth', 'is_teacher']], function() {
// Route::get('missions/create', [MissionController::class, 'store'])->name('mission.create');
// });

// ❌ Middleware de autenticação e verificação de role desativados
Route::prefix('student')->middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student', [StudentController::class, 'dashboard'])->name('student.dashboard');
});

// ❌ Middleware de autenticação e verificação de role desativados
Route::prefix('teacher')->middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
});

Route::get('/auth/typeuser', [AuthTypeUserController::class, 'index'])
    ->name('typeuser.page');

Route::get('/missions/{discipline}/index', [MissionController::class, 'index'])->name('missions.index');

Route::get('/missions/create/{discipline}', [MissionController::class, 'create'])->name('missions.create');

Route::post('/missions', [MissionController::class, 'store'])->name('missions.store');

Route::get('/missions/{mission}/add-questions', [MissionController::class, 'addQuestions'])->name('missions.addQuestions');

Route::post('/missions/{mission}/questions', [MissionController::class, 'storeQuestions'])->name('missions.storeQuestions');

Route::get('/missions/{mission}', [MissionController::class, 'show'])->name('missions.show');

Route::post('/missions/{mission}/submit/{index}', [MissionController::class, 'submit'])->name('missions.submit');

Route::get('/missions/end/{disciplineId}', [MissionController::class, 'end'])->name('missions.end');


require __DIR__ . '/auth.php';
