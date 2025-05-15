<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TrailFeedback;
use App\Models\Mission;
use App\Models\User;


class Trail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    /**
     * Uma trilha pode ter vários feedbacks.
     */
    public function feedbacks()
    {
        return $this->hasMany(TrailFeedbacks::class);
    }

    /**
     * Uma trilha pode conter várias missões.
     */
    public function missions()
    {
        return $this->hasMany(Mission::class);
    }

    public function getCompletionPercentageForUser(User $user): float
    {
        $missions = $this->missions;

        $total = $missions->count();

        if ($total === 0) {
            return 0;
        }

        $completed = $missions->filter(function ($mission) use ($user) {
            return $mission
                ->userProgresses()
                ->where('user_id', $user->id)
                ->whereNotNull('completed_at')
                ->exists();
        })->count();

        return round(($completed / $total) * 100, 2);
    }
}
