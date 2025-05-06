<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'discipline_id',
        'title',
        'start_date',
        'end_date',
        'created_at',
        'updated_at'
    ];

    // Se uma missão pertence a uma disciplina
    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(MissionAnswer::class);
    }

    public function complete(User $user, int $duration)
    {
        $this->users()->updateExistingPivot($user->id, [
            'completed_at' => now(),
            'duration_minutes' => $duration,
        ]);

        $user->addXp($this->xp_reward);
    }

    public function feedbacks() {
        return $this->hasMany(MissionFeedback::class);
    }
}
