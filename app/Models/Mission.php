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
        'updated_at',
        'duration_minutes'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
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

    public function feedbacks()
    {
        return $this->hasMany(MissionFeedback::class);
    }

    public function userProgresses()
    {
        return $this->hasMany(MissionUserProgress::class);
    }

    public function materials()
    {
        return $this->belongsToMany(ContentDiscipline::class, 'material_mission');
    }

    public function results()
    {
        return $this->hasMany(MissionUserResult::class);
    }

    public function usersCompleted() 
    {
        return $this->belongsToMany(User::class)->withPivot('completed_at');
    }


}
