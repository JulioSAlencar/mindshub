<?php

namespace App\Http\Controllers;

use App\Models\Trail;


class TrailController extends Controller
{
    public function averageProgress($trailId)
    {
        $trail = Trail::with(['users.missions' => function ($query) use ($trailId) {
            $query->where('trail_id', $trailId);
        }])->findOrFail($trailId);

        $totalProgress = 0;
        $totalMissions = 0;

        foreach ($trail->users as $user) {
            foreach ($user->missions as $mission) {
                $progress = $mission->pivot->progress ?? 0;
                $totalProgress += $progress;
                $totalMissions++;
            }
        }

        $average = $totalMissions > 0 ? round($totalProgress / $totalMissions, 2) : 0;

        return response()->json([
            'trail_id' => $trailId,
            'average_progress' => $average,
        ]);
    }
}
