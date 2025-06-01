<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\MissionFeedback;
use App\Services\UserRewardService;
use Illuminate\Http\Request;

class MissionFeedbackController extends Controller
{
    protected $rewardService;

    public function __construct(UserRewardService $rewardService)
    {
        $this->rewardService = $rewardService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'mission_id' => 'required|exists:missions,id',
            'category'   => 'nullable|string|max:255',
            'content'    => 'nullable|string|max:1000',
        ]);

        $userId = auth()->id();

        $exists = MissionFeedback::where('user_id', $userId)
            ->where('mission_id', $request->mission_id)
            ->exists();

        if ($exists) {
            if ($request->ajax()) {
                return response()->json(['message' => 'Você já enviou um feedback.'], 422);
            }
            return redirect()->back()->with('success', 'Você já enviou um feedback.');
        }

        MissionFeedback::create([
            'user_id'    => $userId,
            'mission_id' => $request->mission_id,
            'category'   => $request->category,
            'content'    => $request->content,
        ]);

        $this->rewardService->gainXp(auth()->user(), 2);

        if ($request->ajax()) {
            return response()->json(['message' => 'Feedback enviado com sucesso! Você ganhou 2 de XP!']);
        }

        return redirect()->back()->with('success', 'Feedback enviado com sucesso! Você ganhou 2 de XP!');
    }

}
