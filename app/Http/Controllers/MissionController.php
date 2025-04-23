<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MissionController extends Controller
{
    // Listar missões de uma disciplina específica
    public function index(Discipline $discipline)
    {
        $missions = $discipline->missions()->withCount('questions')->get();
        return view('missions.index', compact('missions', 'discipline'));
    }

    // Formulário de criação da missão para uma disciplina específica
    public function create(Discipline $discipline)
    {
        return view('missions.create', compact('discipline'));
    }

    // Armazenar dados básicos da missão
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'discipline_id' => 'required|exists:disciplines,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $mission = Mission::create($request->all());

        return redirect()->route('missions.addQuestions', $mission);
    }

    // Mostrar formulário para adicionar questões (passo 2)
    public function addQuestions(Mission $mission)
    {
        return view('missions.add-questions', compact('mission'));
    }

    // Armazenar questões
    public function storeQuestions(Request $request, Mission $mission)
    {
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
    
        if ($mission->questions->isEmpty()) {
            return redirect()->route('missions.index', $mission->discipline_id)->with('error', 'Esta missão ainda não possui questões.');
        }
    
        $questions = $mission->questions;
    
        $currentQuestion = $questions[0];
        $currentIndex = 0;
    
        return view('missions.show', [
            'mission' => $mission,
            'questions' => $questions, 
            'currentQuestion' => $currentQuestion,
            'currentIndex' => $currentIndex,
        ]);
    }


    public function submit(Mission $mission, $index, Request $request)
    {
        // Validate the incoming request (ensure an answer was selected)
        $request->validate([
            'answer' => 'required|string',
        ]);
    
        // Eager load questions if not already loaded (optional, but good practice)
        $mission->load('questions');
        $questions = $mission->questions;
    
        // --- Optional: Check if the index is valid ---
        if (!isset($questions[$index])) {
            // Index out of bounds, maybe redirect with an error
            return redirect()->route('missions.show', ['mission' => $mission->id])->with('error', 'Questão inválida.');
        }
        // --- End Optional Check ---
    
        // Get the question that was just answered
        $answeredQuestion = $questions[$index];
        $selectedAnswer = $request->input('answer');
    
        // Check if the selected answer is correct
        $isCorrect = ($selectedAnswer === $answeredQuestion->correct_answer);
    
        // --- TODO: Store the result ---
        // Here you would typically store the user's answer, whether it was correct, user ID, etc.
        // Example:
        // AnswerLog::create([
        //     'user_id' => auth()->id(), // Assuming you have user authentication
        //     'mission_id' => $mission->id,
        //     'question_id' => $answeredQuestion->id,
        //     'selected_answer' => $selectedAnswer,
        //     'is_correct' => $isCorrect,
        // ]);
        // --- End TODO ---
    
    
        // Determine the next question index
        $nextIndex = $index + 1;
    
        // Check if there is a next question in this mission
        if ($nextIndex < $questions->count()) {
            // Get the next question
            $nextQuestion = $questions[$nextIndex];
    
            // Show the next question
            return view('missions.show', [
                'mission' => $mission,
                'questions' => $questions, // Pass all questions again
                'currentQuestion' => $nextQuestion, // The next question
                'currentIndex' => $nextIndex,      // The index of the next question
            ]);
        } else {
            // No more questions, the mission is finished
            // Redirect to the end page, passing the discipline ID
            // You might want to pass the mission ID too, or calculate results here
            return redirect()->route('missions.end', ['disciplineId' => $mission->discipline_id])
                             ->with('success', 'Missão concluída!'); // Optional success message
        }
    }

    public function end($disciplineId)
    {
        // You could fetch the discipline name here if needed
        $discipline = Discipline::find($disciplineId);
        // You could also fetch results if you stored them
        // $results = //... query results for the user and this mission/discipline
    
        return view('missions.end', [
            'disciplineId' => $disciplineId,
            'discipline' => $discipline // Pass the discipline object
            // 'results' => $results // Pass results if calculated
            ]);
    }

    
}