<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\MissionFeedback;
use App\Services\UserRewardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MissionFeedbackController extends Controller
{
    protected $rewardService;

    public function __construct(UserRewardService $rewardService)
    {
        $this->rewardService = $rewardService;
    }

    /**
     * Armazena um novo feedback para uma missão.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        // Validação dos dados recebidos
        $request->validate([
            'mission_id' => 'required|exists:missions,id',
            'category'   => 'nullable|string|max:255',
            'content'    => 'nullable|string|max:1000',
        ]);

        $userId = auth()->id();
        $missionId = $request->input('mission_id');

        // Verifica se este usuário específico já enviou feedback para esta missão
        $hasAlreadyProvidedFeedback = MissionFeedback::where('user_id', $userId)
            ->where('mission_id', $missionId)
            ->exists();

        if ($hasAlreadyProvidedFeedback) {
            $message = 'Você já enviou um feedback para esta missão.';
            // Retorna um erro se a requisição for AJAX, ou redireciona com mensagem
            return $request->ajax()
                ? response()->json(['message' => $message], 422)
                : redirect()->back()->with('error', $message);
        }

        // Cria o feedback no banco de dados
        MissionFeedback::create([
            'user_id'    => $userId,
            'mission_id' => $missionId,
            'category'   => $request->input('category'),
            'content'    => $request->input('content'),
        ]);

        // Recompensa o usuário por dar o feedback
        $this->rewardService->gainXp(auth()->user(), 2);

        $message = 'Feedback enviado com sucesso! Você ganhou 2 de XP!';

        // Retorna sucesso para AJAX ou redireciona
        return $request->ajax()
            ? response()->json(['message' => $message])
            : redirect()->back()->with('success', $message);
    }
}
