<?php

namespace App\Http\Controllers;

use App\Models\Badges;
use App\Models\Mission;
use App\Models\Discipline;
use App\Models\MissionAnswer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MissionController extends Controller
{
    // Listar missões de uma disciplina específica
    public function index(Discipline $discipline)
    {
        $missions = $discipline->missions()->withCount('questions')->get();
        return view('missions.index', compact('missions', 'discipline'));
    }

    public function create(Discipline $discipline)
    {
        return view('missions.create', compact('discipline'));
    }

    public function store(Request $request, Mission $mission)
    {
        $userId = auth()->id();

        $alreadyAnswered = MissionAnswer::where('mission_id', $mission->id)
            ->where('user_id', $userId)
            ->exists();
    
        if ($alreadyAnswered) {
            return redirect()->back()->with('error', 'Você já respondeu essa missão.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'discipline_id' => 'required|exists:disciplines,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'duration_minutes' => 'nullable|integer|min:1'
        ]);

        $mission = Mission::create($request->only([
            'title',
            'discipline_id',
            'start_date',
            'end_date',
            'duration_minutes'
        ]));

        return redirect()->route('missions.indexQuestions', [
            'mission' => $mission,
            'disciplineId' => $mission->discipline_id
        ]);
    }

    public function createQuestions(Mission $mission, $disciplineId)
    {
        $discipline = Discipline::findOrFail($disciplineId);

        $oldQuestions = session()->get('temp_questions', []);
        $questionCount = request()->input('questions');

        if (empty($questionCount) || !is_numeric($questionCount) || $questionCount < 1) {
            $questionCount = count($oldQuestions) ?: 1;
        }

        $questionCount = min((int)$questionCount, 10); // Limite de 10 questões

        return view('missions.add-questions', [
            'mission' => $mission,
            'oldQuestions' => $oldQuestions,
            'questionCount' => $questionCount,
            'discipline' => $discipline
        ]);
    }

    public function addQuestion(Request $request, Mission $mission)
    {
        $questions = json_decode($request->input('questions_data'), true) ?? [];
        session()->flash('temp_questions', $questions);

        return redirect()->route('missions.indexQuestions', [
            'mission' => $mission,
            'questions' => min($request->total_questions + 1, 10)
        ]);
    }

    public function removeQuestion(Request $request, Mission $mission)
    {
        $questions = json_decode($request->input('questions_data'), true) ?? [];
        array_pop($questions);

        session()->flash('temp_questions', $questions);

        return redirect()->route('missions.indexQuestions', [
            'mission' => $mission,
            'questions' => max($request->total_questions - 1, 1)
        ]);
    }

    public function updateQuestions(Request $request, Mission $mission)
    {
        $validated = $request->validate([
            'questions' => 'required|array|max:10',
            'questions.*.id' => 'nullable|exists:questions,id',
            'questions.*.statement' => 'required|string',
            'questions.*.correct_answer' => 'required|string',
            'questions.*.explanation' => 'required|string',
            'questions.*.wrong_answers' => 'required|array|size:3',
        ]);

        foreach ($validated['questions'] as $qData) {
            // Busca questão existente ou cria nova
            $question = Question::find($qData['id']) ?? new Question();

            $question->mission_id = $mission->id;
            $question->statement = $qData['statement'];
            $question->correct_answer = $qData['correct_answer'];
            $question->explanation = $qData['explanation'];
            $question->wrong_answers = json_encode($qData['wrong_answers']);

            $question->save();
        }

        return redirect()->route('missions.index', $mission->discipline_id)
                        ->with('success', 'Questões atualizadas com sucesso!');
    }

    public function editQuestionsPage(Mission $mission)
    {
        $questions = $mission->questions->map(function ($q) {
            $wrongAnswers = json_decode($q->wrong_answers, true);

            if (!is_array($wrongAnswers)) {
                $wrongAnswers = [];
            }

            return [
                'id' => $q->id,
                'statement' => $q->statement,
                'correct_answer' => $q->correct_answer,
                'explanation' => $q->explanation,
                'wrong_answers' => array_values($wrongAnswers), // Garante índice 0, 1, 2
            ];
        })->toArray();

        session(['temp_questions' => $questions]);

        return view('missions.update_questions', compact('mission', 'questions'));
    }

    public function showAddQuestionsPage($missionId, $disciplineId)
    {
        // Busca a missão
        $mission = Mission::findOrFail($missionId);

        // Recupera as questões temporárias salvas na sessão, se houver
        $questions = session('temp_questions', []);

        return view('missions.add-questions', [
            'mission' => $mission,
            'disciplineId' => $disciplineId,
            'questions' => $questions
        ]);
    }


    // Armazenar questões
    public function storeQuestions(Request $request, Mission $mission)
    {
        session()->forget('temp_questions');
    
        $request->validate([
            'questions' => 'required|array|min:1',
            'questions.*.statement' => 'required|string',
            'questions.*.correct_answer' => 'required|string',
            'questions.*.explanation' => 'required|string',
            'questions.*.wrong_answers' => 'required|array|size:3',
        ]);

        foreach ($request->questions as $questionData) {
            $mission->questions()->create([
                'statement' => $questionData['statement'],
                'correct_answer' => $questionData['correct_answer'],
                'explanation' => $questionData['explanation'],
                'wrong_answers' => json_encode($questionData['wrong_answers']),
            ]);
        }

        return redirect()->route('missions.index', $mission->discipline_id)->with('success', 'Missão criada com sucesso!');
    }

    public function show(Mission $mission)
    {
        $mission->load('questions');

        if (auth()->user()->role === 'teacher' && $mission->discipline->user_id === auth()->id()) {
            return redirect()->route('missions.index', $mission->discipline_id)
                ->with('error', 'Você não pode responder à sua própria missão.');
        }        
    
        if ($mission->questions->isEmpty()) {
            return redirect()->route('missions.index', $mission->discipline_id)->with('error', 'Esta missão ainda não possui questões.');
        }
  
        $questions = $mission->questions;
    
        $currentQuestion = $questions[0];
        $currentIndex = 0;

        $alreadyAnswered = MissionAnswer::where('mission_id', $mission->id)
        ->where('user_id', auth()->id())
        ->exists();

    
        return view('missions.show', [
            'mission' => $mission,
            'questions' => $questions, 
            'currentQuestion' => $currentQuestion,
            'currentIndex' => $currentIndex,
            'alreadyAnswered' => $alreadyAnswered,
        ]);
    }


    public function submit(Mission $mission, $index, Request $request, MissionAnswer $answerService)
    {
        $request->validate([
            'answer' => 'required|string',
        ]);

        $mission->load('questions');
        $questions = $mission->questions;

        if (!isset($questions[$index])) {
            return redirect()->route('missions.show', $mission->id)->with('error', 'Questão inválida.');
        }

        $question = $questions[$index];
        $selectedAnswer = $request->input('answer');

        $answerService->storeAnswer($mission, $question, $selectedAnswer);

        $nextIndex = $index + 1;

        if ($nextIndex < $questions->count()) {
            return view('missions.show', [
                'mission' => $mission,
                'questions' => $questions,
                'currentQuestion' => $questions[$nextIndex],
                'currentIndex' => $nextIndex,
            ]);
        }

        return redirect()->route('missions.end', ['mission' => $mission])
        ->with('success', 'Missão concluída!');
    }


    public function end(Mission $mission)
    {
        $discipline = $mission->discipline;
    
        if (!$discipline) {
            return redirect()->route('dashboard')->with('error', 'Disciplina da missão não encontrada.');
        }
    
        return view('missions.end', [
            'discipline' => $discipline,
            'mission' => $mission,
        ]);
    }
    

    public function result(Mission $mission)
    {
        $user = auth()->user();

        $answers = $mission->answers()->where('user_id', $user->id)->with('question')->get();

        $totalQuestions = $answers->count();
        $correctAnswers = $answers->where('is_correct', true)->count();
        $score = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;

        return view('missions.result', compact('mission', 'answers', 'score', 'correctAnswers', 'totalQuestions'));
    }

    public function responses(Mission $mission)
    {
        $discipline = Discipline::findOrFail($mission->discipline_id); 
    
        $responses = MissionAnswer::with('user', 'question')
            ->where('mission_id', $mission->id)
            ->get()
            ->groupBy('user_id');

        return view('missions.responses', compact('mission', 'responses', 'discipline'));
    }

    public function complete(Mission $mission)
    {
        $user = Auth::user();
    
        // Evita concluir mais de uma vez
        if ($user->missions()->where('mission_id', $mission->id)->exists()) {
            return back()->with('message', 'Missão já concluída.');
        }
    
        $user->missions()->attach($mission->id, ['completed_at' => now()]);
    
        // Adiciona XP e verifica level/medalhas
        $user->addXp($mission->xp_reward);
    
        return back()->with('success', 'Missão concluída! XP recebido.');
    }

    public function completeMission(Request $request)
{
    $user = auth()->user();
    $missionId = $request->input('mission_id');

    $user->missions()->updateExistingPivot($missionId, ['progress' => 100]);

    $badge = Badges::where('name', 'Conquistador de Missão')->first();

    if ($badge && !$user->badges()->where('badge_id', $badge->id)->exists()) {
        $user->badges()->attach($badge->id, ['unlocked_at' => now()]);
    }

    return response()->json(['message' => 'Missão concluída e badge avaliado.']);
}

public function uploadMaterial(Request $request)
    {
    $request->validate([
        'material' => 'required|file|mimes:pdf,docx,zip,mp4|max:10240' // 10MB
    ]);

    if ($request->hasFile('material')) {
        $filename = time().'_'.$request->file('material')->getClientOriginalName();
        $path = $request->file('material')->storeAs('materials', $filename, 'public');

        return response()->json(['success' => true, 'path' => $path]);
    }

    return response()->json(['success' => false], 400);
    }

    public function associateMaterial(Request $request, $missionId)
    {
    $request->validate([
        'material_id' => 'required|exists:materials,id'
    ]);

    $mission = Mission::findOrFail($missionId);
    $mission->materials()->attach($request->material_id);

    return response()->json(['message' => 'Material associado com sucesso.']);
    }
}