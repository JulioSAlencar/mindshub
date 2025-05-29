<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\MissionFeedback;
use Illuminate\Http\Request;

class MissionFeedbackController extends Controller
{
    public function store(Request $request, Mission $mission)
    {
        $request->validate([
            'content' => 'nullable|string|max:1000',
            'category' => 'nullable|string|max:255'
        ]);

        MissionFeedback::create([
            'mission_id' => $mission->id,
            'user_id' => auth()->id(),
            'content' => $request->content,
            'category' => $request->category
        ]);

        // Recompensa automática (critério: feedback com +20 caracteres)
        if (strlen($request->content) >= 20) {
            auth()->user()->addXp(20);
        }

        return redirect()->route('missions.result', $mission)->with('success', 'Feedback enviado com sucesso!');
    }
}
