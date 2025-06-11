<?php

namespace App\Services;

use App\Models\User;
use App\Models\Medal;
use App\Notifications\MedalAwardedNotification;
use Illuminate\Support\Facades\Session;

class UserRewardService
{
    public function initializeNewUser(User $user): void
    {
        $user->xp = max(1, $user->xp ?? 1);
        $user->level = max(1, $user->level ?? 1);
        $user->save();

        $this->checkAndAwardMedals($user);
    }

    public function gainXp(User $user, int $amount): void
    {
        if ($amount <= 0) return;

        $user->xp += $amount;
        $previousLevel = $user->level;
        $user->level = $this->calculateLevelFromXp($user->xp);
        $user->save();

        $this->checkAndAwardMedals($user);

        if ($user->level > $previousLevel) {
            Session::flash('level_up', "Parabéns! Você subiu para o Nível {$user->level}!");
        }
    }

    private function calculateLevelFromXp(int $xp): int
    {
        for ($level = 100; $level >= 1; $level--) {
            $requiredXp = 1 + intval(pow(($level - 1) / 99, 2) * (10000 - 1));
            if ($xp >= $requiredXp) return $level;
        }

        return 1;
    }

    public static function getLevelXpRequirementsMapping(): array
    {
        $xpMap = [1 => 1];
        for ($level = 2; $level <= 100; $level++) {
            $ratio = ($level - 1) / 99;
            $xpMap[$level] = 1 + intval(pow($ratio, 2) * (10000 - 1));
        }
        return $xpMap;
    }

    public function checkAndAwardMedals(User $user): void
    {
        $awarded = Medal::where('condition_type', 'level')
            ->where('condition_value', '<=', $user->level)
            ->get()
            ->reject(fn($medal) => $user->hasMedal($medal))
            ->each(function ($medal) use ($user) {
                $user->medals()->attach($medal->id, ['earned_at' => now()]);
                $user->notify(new MedalAwardedNotification($medal));
            });

        if ($awarded->isNotEmpty()) {
            Session::flash('awarded_medals_messages', $awarded->map(function ($medal) {
                $icon = $medal->icon ? "<img src='" . asset($medal->icon) . "' style='width: 24px;'>" : "🏅";
                return "{$icon} <strong>{$medal->name}</strong>: {$medal->description}";
            })->toArray());
        }
    }
}
