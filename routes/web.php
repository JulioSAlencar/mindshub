<?php

use Illuminate\Support\Facades\Route;

// Rotas públicas básicas
Route::view('/', 'welcome');
Route::view('/escolha', 'users.escolha-usuario');
Route::view('/home', 'users.home');
Route::view('/termos', 'TermsOfUse')->name('termos');
Route::view('/raking', 'raking.globraking')->name('raking.page');

// Importando arquivos de rotas separados
require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
require __DIR__.'/disciplines.php';
require __DIR__.'/missions.php';
require __DIR__.'/questions.php';
require __DIR__.'/certificate.php';
require __DIR__.'/forum.php';
require __DIR__.'/evaluation.php';
require __DIR__.'/tracks.php';
require __DIR__.'/progress.php';
require __DIR__.'/performance.php';
require __DIR__.'/feedback.php';
require __DIR__.'/trails.php';
require __DIR__.'/lesson_comments.php';
require __DIR__.'/Notification.php';
