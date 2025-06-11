<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Models\Mission;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function createQuestions(Mission $mission, $disciplineId)
    {
        $discipline = Discipline::findOrFail($disciplineId);

        $oldQuestions = session()->get('temp_questions', []);
        $questionCount = request()->input('questions');

        if (empty($questionCount) || !is_numeric($questionCount) || $questionCount < 1) {
            $questionCount = count($oldQuestions) ?: 1;
        }

        $questionCount = min((int)$questionCount, 10); // Limite de 10 questões

        return view('questions.add-questions', [
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

        return redirect()->route('questions.remove', [
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

        return view('questions.update_questions', compact('mission', 'questions'));
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
}
