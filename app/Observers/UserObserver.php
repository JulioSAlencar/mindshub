<?php

namespace App\Observers;

use App\Models\User;
use App\Services\UserRewardService;

class UserObserver
{
    public function updated(User $user): void
    {
        if ($user->wasChanged('xp') || $user->wasChanged('level')) {
            // Usa o serviço para verificar e premiar medalhas
            app(UserRewardService::class)->checkAndAwardMedals($user);
        }
    }
}
