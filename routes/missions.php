<?php

use App\Http\Controllers\MissionController;
use App\Http\Controllers\MissionProgressController;
use Illuminate\Support\Facades\Route;


Route::prefix('missions')->group(function () {
    Route::get('{discipline}/index', [MissionController::class, 'index'])->name('missions.index');
    Route::get('{discipline}/create', [MissionController::class, 'create'])->name('missions.create');
    Route::post('/', [MissionController::class, 'store'])->name('missions.store');
    
    Route::get('{mission}/show', [MissionController::class, 'show'])->name('missions.show');
    Route::post('{mission}/submit/{index}', [MissionController::class, 'submit'])->name('missions.submit');
    Route::get('{mission}/end', [MissionController::class, 'end'])->name('missions.end');
    Route::get('{mission}/result', [MissionController::class, 'result'])->name('missions.result');
    Route::get('{mission}/responses', [MissionController::class, 'responses'])->name('missions.responses');
    Route::post('{mission}/complete', [MissionController::class, 'complete'])->name('missions.complete');
    Route::post('/complete-mission', [MissionController::class, 'completeMission'])->name('missions.completeMission');
    Route::delete('{mission}', [MissionController::class, 'destroy'])->name('missions.destroy');
});

