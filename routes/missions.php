<?php

use App\Http\Controllers\MissionController;
use App\Http\Controllers\MissionProgressController;
use Illuminate\Support\Facades\Route;

Route::prefix('missions')->group(function () {
    Route::get('{discipline}/index', [MissionController::class, 'index'])->name('missions.index');
    Route::get('{mission}', [MissionController::class, 'show'])->name('missions.show');
    Route::get('{mission}/result', [MissionController::class, 'result'])->name('missions.result');
    Route::get('{mission}/responses', [MissionController::class, 'responses'])->name('missions.responses');
    Route::get('create/{discipline}', [MissionController::class, 'create'])->name('missions.create');
    Route::post('/', [MissionController::class, 'store'])->name('missions.store');
    Route::delete('{mission}', [MissionController::class, 'destroy'])->name('missions.destroy');
    Route::post('{mission}/submit/{index}', [MissionController::class, 'submit'])->name('missions.submit');
    Route::get('{mission}/end', [MissionController::class, 'end'])->name('missions.end');

    Route::post('{userId}/{missionId}/progress', [MissionProgressController::class, 'updateProgress']);
    Route::post('{userId}/{missionId}/check-badge', [MissionProgressController::class, 'checkBadge']);
});
