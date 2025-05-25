<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{

    public function updated(User $user): void
    {

        if ($user->wasChanged('xp') || $user->wasChanged('level')) {
            $user->checkAndAwardMedals();
        }
    }


}
