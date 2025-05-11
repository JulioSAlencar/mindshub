<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Performance;

class PerformanceController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'track_id' => 'required|exists:tracks,id',
        'mission_score' => 'nullable|numeric|min:0|max:10',
        'practical_score' => 'nullable|numeric|min:0|max:10',
    ]);

    $overall = ($request->mission_score + $request->practical_score) / 2;

    Performance::updateOrCreate(
        ['user_id' => $request->user_id, 'track_id' => $request->track_id],
        [
            'mission_score' => $request->quiz_score,
            'practical_score' => $request->practical_score,
            'overall_score' => $overall,
        ]
    );

    return back()->with('success', 'Desempenho registrado!');
}

}
