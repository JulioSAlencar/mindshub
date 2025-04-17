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

Route::get('/disciplines/content', [DisciplineController::class, 'content'])->name('disciplines.content');
Route::get('/disciplines/page', [DisciplineController::class, 'index'])->name('disciplines.page');
Route::get('/disciplines/content', [DisciplineController::class, 'content'])->name('disciplines.content');
Route::get('/disciplines/index', [DisciplineController::class, 'mission'])->name('disciplines.index');
Route::get('/disciplines/create', [DisciplineController::class, 'create'])->name('disciplines.create');
Route::get('/disciplines/{id}', [DisciplineController::class, 'show'])->name('disciplines.show');
Route::post('/disciplines', [DisciplineController::class, 'store']);

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


Route::get('/missions/create/{discipline}', [MissionController::class, 'create'])->name('missions.create');
Route::post('/missions', [MissionController::class, 'store'])->name('missions.store');



require __DIR__ . '/auth.php';
