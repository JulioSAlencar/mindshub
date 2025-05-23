<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{

    public function updated(User $user): void
    {
        // Verifica se houve mudança em xp ou level
        if ($user->wasChanged('xp') || $user->wasChanged('level')) {
            $user->checkAndAwardNewMedals($user);
        }
    }

}
