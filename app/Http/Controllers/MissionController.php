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

        return redirect()->route('questions.create', [
            'mission' => $mission,
            'disciplineId' => $mission->discipline_id
        ]);
    }
    
    public function destroy(Mission $mission)
    {
        $disciplineId = $mission->discipline_id;

        $mission->delete(); // isso deve deletar as questões também, automaticamente

        return redirect()->route('disciplines.showContent', $disciplineId)
            ->with('success', 'Missão excluída com sucesso!');
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
    
        return view('questions.end', [
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
}