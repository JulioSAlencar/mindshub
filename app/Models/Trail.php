<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TrailFeedbacks;
use App\Models\Mission;
use App\Models\User;
use App\Models\MissionUserResult;

class Trail extends Model
{
    use HasFactory;

    protected $fillable = ['name']; 

    public function feedbacks()
    {
        return $this->hasMany(TrailFeedbacks::class); // Corrigido o nome do modelo
    }

    public function missions()
    {
        return $this->belongsToMany(Mission::class, 'mission_trail')
                    ->withPivot('order')
                    ->orderBy('order', 'asc'); // use o nome real da coluna pivot
    }


    public function getProgressForUser(User $user)
    {
        $total = $this->missions()->count();
        if ($total === 0) return 0;

        $completed = MissionUserResult::where('user_id', $user->id)
            ->whereIn('mission_id', $this->missions()->pluck('missions.id'))
            ->where('progress', 100)
            ->distinct('mission_id')
            ->count();

        return ($completed / $total) * 100;
    }

    public function isCompletedBy(User $user)
    {
        $total = $this->missions()->count();

        $completed = MissionUserResult::where('user_id', $user->id)
        ->whereIn('mission_id', $this->missions()->pluck('missions.id'))
        ->where('completion', 100) // usar o nome certo da coluna
        ->distinct('mission_id')
        ->count();

        return $total > 0 && $completed === $total;
    }
}