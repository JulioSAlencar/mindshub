<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $missions = Mission::with('discipline')
            ->orderBy('start_date', 'desc')
            ->paginate(10);

        return view('missions.index', compact('missions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Verifica se o usuário é professor (usando Policies ou Gates)
        if (!Gate::allows('is-teacher')) {
            abort(403, 'Apenas professores podem criar missões');
        }

        $disciplines = Discipline::all();
        return view('missions.create', compact('disciplines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'discipline_id' => 'required|exists:disciplines,id',
            'statement' => 'required|string|min:10',
            'correct_answer' => 'required|string',
            'explanation' => 'required|string|min:10',
            'wrong_answers' => 'required|array|min:3',
            'wrong_answers.*' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $mission = Mission::create([
                'discipline_id' => $request->discipline_id,
                'statement' => $request->statement,
                'correct_answer' => $request->correct_answer,
                'explanation' => $request->explanation,
                'wrong_answers' => $request->wrong_answers,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            return redirect()->route('missions.show', $mission->id)
                ->with('success', 'Missão criada com sucesso!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao criar missão: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mission = Mission::with('discipline')->findOrFail($id);
        return view('missions.show', compact('mission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mission = Mission::findOrFail($id);
        $disciplines = Discipline::all();

        return view('missions.edit', compact('mission', 'disciplines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mission = Mission::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'discipline_id' => 'required|exists:disciplines,id',
            'statement' => 'required|string|min:10',
            'correct_answer' => 'required|string',
            'explanation' => 'required|string|min:10',
            'wrong_answers' => 'required|array|min:3',
            'wrong_answers.*' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $mission->update($request->all());
            return redirect()->route('missions.show', $mission->id)
                ->with('success', 'Missão atualizada com sucesso!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao atualizar missão: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mission = Mission::findOrFail($id);
        
        try {
            $mission->delete();
            return redirect()->route('missions.index')
                ->with('success', 'Missão removida com sucesso!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao remover missão: ' . $e->getMessage());
        }
    }
}