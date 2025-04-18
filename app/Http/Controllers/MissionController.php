<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MissionController extends Controller
{
    public function create($disciplineId)
    {
        $discipline = Discipline::findOrFail($disciplineId);
        return view('missions.create', compact('discipline'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'discipline_id' => 'required|exists:disciplines,id',
            'missions' => 'required|array|min:1 | max:10',
            'missions.*.statement' => 'required|string',
            'missions.*.correct_answer' => 'required|string',
            'missions.*.explanation' => 'required|string',
            'missions.*.wrong_answers' => 'required|array|size:3',
            'missions.*.start_date' => 'required|date',
            'missions.*.end_date' => 'required|date|after:missions.*.start_date',
        ]);

        foreach ($validated['missions'] as $missionData) {
            Mission::create([
                'discipline_id' => $validated['discipline_id'],
                'statement' => $missionData['statement'],
                'correct_answer' => $missionData['correct_answer'],
                'explanation' => $missionData['explanation'],
                'wrong_answers' => json_encode($missionData['wrong_answers']),
                'start_date' => $missionData['start_date'],
                'end_date' => $missionData['end_date'],
            ]);
        }

        return redirect()->route('disciplines.content', ['id' => $validated['discipline_id']])
            ->with('success', 'Missões criadas com sucesso!');
    }

}