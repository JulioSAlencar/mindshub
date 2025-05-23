<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Medal;
use Illuminate\Http\Request;

class MedalController extends Controller
{
    private function calculateLevel(int $xp) 
    {
        return (int) floor($xp / 100) + 1;
    }

    public function checkForNewMedals(User $user) 
    {
        $availableMedals = Medal::where('xp_required', '<=', $user->xp)->get();

        foreach($availableMedals as $medal) {
            if (!$user->medals()->where('medals.id', $medal->id)->exists()) {
                $user->medals()->attach($medal->id, ['earned_at' => now()]);
            }
        }
    }
}
