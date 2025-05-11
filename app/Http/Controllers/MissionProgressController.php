<?php

namespace App\Http\Controllers;

use App\Models\Badges;
use App\Models\MissionUserProgress;
use Illuminate\Http\Request;

class MissionProgressController extends Controller
{
    public function updateProgress(Request $request, $userId, $missionId)
    {
        $data = $request->validate([
            'progress' => 'required|integer|min:0|max:100',
            'time_remaining' => 'nullable|integer|min:0',
        ]);

        $progress = MissionUserProgress::updateOrCreate(
            ['user_id' => $userId, 'mission_id' => $missionId],
            [
                'progress' => $data['progress'],
                'time_remaining' => $data['time_remaining'],
                'last_paused_at' => now()
            ]
        );

        return response()->json(['message' => 'Progresso atualizado', 'data' => $progress]);
    }

    public function checkAndUnlockBadge($userId, $missionId)
    {
        $progress = MissionUserProgress::where('user_id', $userId)
            ->where('mission_id', $missionId)
            ->where('progress', 100)
            ->first();

        if ($progress) {
            $badge = Badges::where('name', 'Conquistador de Missão')->first();

            if ($badge && !$progress->user->badges->contains($badge->id)) {
                $progress->user->badges()->attach($badge->id, ['unlocked_at' => now()]);
            }
        }
    }
}
