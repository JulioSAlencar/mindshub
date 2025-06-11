<?php

use App\Http\Controllers\CertificateController;
use Illuminate\Support\Facades\Route;

// Gerar certificado
Route::get('/certificates/generate/{disciplineId}', [CertificateController::class, 'generate'])
    ->name('certificates.generate')
    ->middleware('auth');

// Fazer download do certificado
Route::get('/certificates/download/{id}', [CertificateController::class, 'download'])
    ->name('certificates.download')
    ->middleware('auth');
