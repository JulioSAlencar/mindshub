<?php

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::prefix('questions')->name('questions.')->group(function () {
    Route::get('create/{mission}/{disciplineId}', [QuestionController::class, 'createQuestions'])->name('create');
    Route::post('add/{mission}', [QuestionController::class, 'addQuestion'])->name('add');
    Route::post('remove/{mission}', [QuestionController::class, 'removeQuestion'])->name('remove');
    Route::put('update/{mission}', [QuestionController::class, 'updateQuestions'])->name('update');
    Route::get('edit/{mission}', [QuestionController::class, 'editQuestionsPage'])->name('edit');
    Route::get('show-add/{missionId}/{disciplineId}', [QuestionController::class, 'showAddQuestionsPage'])->name('showAdd');
    Route::post('store/{mission}', [QuestionController::class, 'storeQuestions'])->name('store');
});
