<?php

use App\Http\Controllers\Auth\TypeUserController as AuthTypeUserController;
use App\Http\Controllers\ContentDisciplineController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrailController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ForumController;
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

Route::prefix('contents')->group(function () {
    // Formulário de edição de conteúdo
    Route::get('{id}/editar', [ContentDisciplineController::class, 'edit'])->name('contents.editContents');
    
    Route::get('{id}/editar-content', [ContentDisciplineController::class, 'editContent'])->name('contents.editContent');
    

    // Atualizar conteúdo
    Route::put('{id}', [ContentDisciplineController::class, 'update'])->name('contents.update');

    // Excluir conteúdo
    Route::delete('{id}', [ContentDisciplineController::class, 'destroy'])->name('contents.destroy');

    Route::put('{id}/approve', [ContentController::class, 'approve'])->name('contents.approve');
});


Route::get('/trails/{id}/average-progress', [TrailController::class, 'averageProgress']);


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

// Adição e Atualização de Questões
Route::get('/missions/{mission}/add-questions/{disciplineId}', [MissionController::class, 'createQuestions'])->name('missions.indexQuestions');
Route::get('/missions/{mission}/edit-questions', [MissionController::class, 'editQuestionsPage'])->name('missions.editQuestions');
Route::put('/missions/{mission}/update-questions', [MissionController::class, 'updateQuestions'])->name('missions.updateQuestions');
Route::post('/missions/{mission}/questions', [MissionController::class, 'storeQuestions'])->name('missions.storeQuestions');
Route::post('/missions/{mission}/add-question', [MissionController::class, 'addQuestion'])->name('missions.addQuestion');
Route::post('/missions/{mission}/remove-question', [MissionController::class, 'removeQuestion'])->name('missions.removeQuestion');

// Submissão e Finalização de Missões
Route::post('/missions/{mission}/submit/{index}', [MissionController::class, 'submit'])->name('missions.submit');
Route::get('/missions/{mission}/end', [MissionController::class, 'end'])->name('missions.end');

// Edição e deleção de Topic
Route::put('/forum/topic/{id}', [ForumController::class, 'updateTopic'])->name('forum.topic.update');
Route::delete('/forum/topic/{id}', [ForumController::class, 'destroyTopic'])->name('forum.topic.destroy');

// Edição e deleção de Reply
Route::put('/forum/reply/{id}', [ForumController::class, 'updateReply'])->name('forum.reply.update');
Route::delete('/forum/reply/{id}', [ForumController::class, 'destroyReply'])->name('forum.reply.destroy');


require __DIR__ . '/auth.php';
