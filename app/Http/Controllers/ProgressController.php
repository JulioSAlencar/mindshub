<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;

class ProgressController extends Controller
{
    public function update(Request $request, $trackId)
{
    $request->validate([
        'missions_completed' => 'required|integer',
        'time_spent_minutes' => 'required|integer',
    ]);

    $progress = Progress::updateOrCreate(
        ['user_id' => auth()->id(), 'track_id' => $trackId],
        $request->only(['missions_completed', 'time_spent_minutes'])
    );

    return response()->json(['message' => 'Progresso atualizado!', 'progress' => $progress]);
}

}
