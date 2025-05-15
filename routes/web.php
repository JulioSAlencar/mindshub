<?php

use App\Http\Controllers\Auth\TypeUserController as AuthTypeUserController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ClassModelController;
use App\Http\Controllers\ContentDisciplineController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\MissionCommentController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\MissionProgressController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrailController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\QuestionController;
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

Route::get('/raking', function () {
    return view('raking.globraking');
})->name('raking.page');

Route::middleware(['auth'])->group(function () {

    // Página principal e visualização
    Route::get('/disciplines/page', [DisciplineController::class, 'index'])->name('disciplines.page'); // Página principal
    Route::get('/disciplines/content/{id}', [DisciplineController::class, 'showContent'])->name('disciplines.showContent'); // Mostrar conteúdos de uma disciplina
    Route::get('/disciplines/subscribed/', [DisciplineController::class, 'disciplinesParticipant'])->name('disciplines.participating'); // Mostrar conteúdos de uma disciplina

    // CRUD de disciplinas
    Route::get('/disciplines/create', [DisciplineController::class, 'create'])->name('disciplines.create'); // Formulário de criação
    Route::post('/disciplines', [DisciplineController::class, 'store'])->name('disciplines.store'); // Salvar disciplina

    Route::get('/disciplines/{id}', [DisciplineController::class, 'show'])->name('disciplines.show'); // Visualizar disciplina
    Route::post('/disciplines/join/{id}', [DisciplineController::class, 'joinDiscipline'])->name('disciplines.join'); // Participar

    Route::get('/disciplines/edit/{id}', [DisciplineController::class, 'edit'])->name('disciplines.edit'); // Formulário de edição
    Route::put('/disciplines/update/{id}', [DisciplineController::class, 'update'])->name('disciplines.update'); // Atualizar disciplina
    Route::delete('/disciplines/{id}', [DisciplineController::class, 'destroy'])->name('disciplines.destroy'); // Excluir disciplina
});

Route::prefix('disciplines')->group(function () {
    // Formulário para adicionar novo conteúdo
    Route::get('{id}/contents', [ContentDisciplineController::class, 'index'])->name('contents.createForm');

    // Salvar novo conteúdo
    Route::post('{id}/contents', [ContentDisciplineController::class, 'store'])->name('contents.store');

});
// routes/web.php
Route::get('/disciplinas/{id}/conteudos', [ContentDisciplineController::class, 'showContents'])
    ->name('contents.view');


// Formulário de edição de conteúdo
    
    Route::get('{id}/editarcontent', [ContentDisciplineController::class, 'editContent'])->name('contents.updateContents');
    
    // Atualizar conteúdo
    Route::put('{id}', [ContentDisciplineController::class, 'update'])->name('contents.update');

    // Excluir conteúdo
    Route::delete('{id}', [ContentDisciplineController::class, 'destroy'])->name('contents.destroy');

    Route::put('{id}/approve', [ContentController::class, 'approve'])->name('contents.approve');



Route::get('/trails/{id}/average-progress', [TrailController::class, 'averageProgress']);
// Endpoint das disciplinas das trilhas

Route::get('/trails', [TrailController::class, 'show'])->name('trails.show');

// Checa se a trilha tá completa
Route::post('/trails/{trail}/check-completion', [TrailController::class, 'checkCompletion'])->name('trails.checkCompletion');

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

// Listagem e Visualização
Route::get('/missions/{discipline}/index', [MissionController::class, 'index'])->name('missions.index');
Route::get('/missions/{mission}', [MissionController::class, 'show'])->name('missions.show');
Route::get('/missions/{mission}/result', [MissionController::class, 'result'])->name('missions.result');
Route::get('/missions/{mission}/responses', [MissionController::class, 'responses'])->name('missions.responses');

// Criação de Missões
Route::get('/missions/create/{discipline}', [MissionController::class, 'create'])->name('missions.create');
Route::post('/missions', [MissionController::class, 'store'])->name('missions.store');
Route::delete('/missions/{mission}', [MissionController::class, 'destroy'])->name('missions.destroy');

// Submissão e Finalização de Missões
Route::post('/missions/{mission}/submit/{index}', [MissionController::class, 'submit'])->name('missions.submit');
Route::get('/missions/{mission}/end', [MissionController::class, 'end'])->name('missions.end');

Route::prefix('questions')->name('questions.')->group(function () {
    Route::get('create/{mission}/{disciplineId}', [QuestionController::class, 'createQuestions'])->name('create');
    Route::post('add/{mission}', [QuestionController::class, 'addQuestion'])->name('add');
    Route::post('remove/{mission}', [QuestionController::class, 'removeQuestion'])->name('remove');
    Route::put('update/{mission}', [QuestionController::class, 'updateQuestions'])->name('update');
    Route::get('edit/{mission}', [QuestionController::class, 'editQuestionsPage'])->name('edit');
    Route::get('show-add/{missionId}/{disciplineId}', [QuestionController::class, 'showAddQuestionsPage'])->name('showAdd');
    Route::post('store/{mission}', [QuestionController::class, 'storeQuestions'])->name('store');
});

// Edição e deleção de Topic
Route::put('/forum/topic/{id}', [ForumController::class, 'updateTopic'])->name('forum.topic.update');
Route::delete('/forum/topic/{id}', [ForumController::class, 'destroyTopic'])->name('forum.topic.destroy');

// Marcar o comentário como construtitvo
Route::post('/forum/reply/{id}/toggle-constructive', [ForumController::class, 'toggleConstructive'])->name('forum.reply.toggleConstructive');

// Edição e deleção de Reply
Route::put('/forum/reply/{id}', [ForumController::class, 'updateReply'])->name('forum.reply.update');
Route::delete('/forum/reply/{id}', [ForumController::class, 'destroyReply'])->name('forum.reply.destroy');

// Post de avaliações
Route::post('/evaluations', [EvaluationController::class, 'store'])->name('evaluations.store')->middleware('auth');

// Endpoint de track de missões
Route::resource('/tracks', TrackController::class);
Route::get('/tracks/filter', [TrackController::class, 'filter']);


// Endpoint de acompanhamento de progresso
Route::post('/progress/{trackId}', [ProgressController::class, 'update']);

// Endpoint de performance
Route::post('/performances', [PerformanceController::class, 'store']);

// Endpoint de feedback dos estudantes
Route::post('/feedbacks', [FeedbackController::class, 'store']);
Route::get('/feedbacks/student/{id}', [FeedbackController::class, 'showByStudent']);

// Endpoint para missions comments
Route::prefix('lesson-comments')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [MissionCommentController::class, 'store']);
    Route::put('/{id}', [MissionCommentController::class, 'update']);
    Route::delete('/{id}', [MissionCommentController::class, 'destroy']);
});

// Endpoint de class models/classrooms
Route::prefix('class-rooms')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [ClassModelController::class, 'index']);
    Route::post('/', [ClassModelController::class, 'store']);
    Route::put('/{id}', [ClassModelController::class, 'update']);
    Route::delete('/{id}', [ClassModelController::class, 'destroy']);
    Route::post('/{id}/students', [ClassModelController::class, 'addStudents']);
});

// Endpoint de progresso de usuário nas missions
Route::post('/missions/{userId}/{missionId}/progress', [MissionProgressController::class, 'updateProgress']);
Route::post('/missions/{userId}/{missionId}/check-badge', [MissionProgressController::class, 'checkAndUnlockBadge']);

Route::middleware(['auth'])->group(function () {
    Route::get('/certificates/generate/{disciplineId}', [CertificateController::class, 'generate'])->name('certificates.generate');
    Route::get('/certificates/download/{id}', [CertificateController::class, 'download'])->name('certificates.download');
});

require __DIR__ . '/auth.php';
