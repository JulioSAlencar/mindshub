<?php

use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\ContentDisciplineController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DisciplineStudentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/disciplines/page', [DisciplineController::class, 'index'])->name('disciplines.page');
    Route::get('/disciplines/content/{id}', [DisciplineController::class, 'showContent'])->name('disciplines.showContent');
    Route::get('/disciplines/subscribed', [DisciplineController::class, 'disciplinesParticipant'])->name('disciplines.participating');
    Route::get('/disciplines/manager/{id}', [DisciplineController::class, 'manager'])->name('disciplines.manager');

    Route::get('/disciplines/create', [DisciplineController::class, 'create'])->name('disciplines.create');
    Route::post('/disciplines', [DisciplineController::class, 'store'])->name('disciplines.store');
    Route::get('/disciplines/{id}', [DisciplineController::class, 'show'])->name('disciplines.show');
    Route::post('/disciplines/join/{id}', [DisciplineController::class, 'joinDiscipline'])->name('disciplines.join');
    Route::get('/disciplines/edit/{id}', [DisciplineController::class, 'edit'])->name('disciplines.edit');
    Route::put('/disciplines/update/{id}', [DisciplineController::class, 'update'])->name('disciplines.update');
    Route::delete('/disciplines/{id}', [DisciplineController::class, 'destroy'])->name('disciplines.destroy');
});

Route::prefix('disciplines')->group(function () {
    Route::get('{id}/contents', [ContentDisciplineController::class, 'index'])->name('contents.createForm');
    Route::post('{id}/contents', [ContentDisciplineController::class, 'store'])->name('contents.store');
});

Route::get('/disciplinas/{id}/conteudos', [ContentDisciplineController::class, 'showContents'])->name('contents.view');
Route::get('{id}/editarcontent', [ContentDisciplineController::class, 'editContent'])->name('contents.updateContents');
Route::put('{id}', [ContentDisciplineController::class, 'update'])->name('contents.update');
Route::delete('{id}', [ContentDisciplineController::class, 'destroy'])->name('contents.destroy');
Route::put('{id}/approve', [ContentController::class, 'approve'])->name('contents.approve');

Route::get('/disciplines/students/{id}', [DisciplineStudentController::class, 'showStudents'])->name('disciplines.showStudents');
