<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Models\Trail;
use Illuminate\Support\Facades\Auth;

class TrailController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $disciplines = Discipline::with('missions')
            ->where('creator_id', '!=', $user->id)
            ->get()
            ->map(function ($discipline) use ($user) {
                $discipline->total = $discipline->missions->count();
                $discipline->completed = $discipline->missions->filter(function ($mission) use ($user) {
                    return $mission->usersCompleted->contains($user);
                })->count();

                return $discipline;
            });

        return view('trails.show', compact('disciplines'));
    }
}
