<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Models\Trail;


class TrailController extends Controller
{
    public function averageProgress($trailId)
    {
        $trail = Trail::with('missions')->findOrFail($trailId);
        $user = auth()->user();

        $completionPercentage = $trail->getCompletionPercentageForUser($user);

        return response()->json([
            'trail_id' => $trail->id,
            'user_id' => $user->id,
            'completion_percentage' => $completionPercentage
        ]);
    }

    public function show()
    {
        $user = auth()->user();

        // Buscar todas as disciplinas que o usuário está inscrito
        $disciplines = $user->disciplinesParticipant()->with('missions')->get();

        // Coletar todas as missões dessas disciplinas
        $missions = $disciplines->flatMap(function ($discipline) {
            return $discipline->missions;
        });

        return view('trails.show', compact('disciplines', 'missions'));
    }


    public function checkCompletion($trailId)
    {
        $trail = Trail::with('missions')->findOrFail($trailId);
        $user = auth()->user();

        $missionsRequired = $trail->missions->pluck('id')->toArray();
        $missionsCompleted = $user->missions()->whereIn('mission_id', $missionsRequired)->where('progress', 100)->pluck('mission_id')->toArray();

        $completed = count(array_diff($missionsRequired, $missionsCompleted)) === 0;

        return response()->json(['completed' => $completed]);
    }
}
