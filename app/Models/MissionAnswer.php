<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Mission;

class MissionAnswer extends Model
{
    protected $fillable = [
        'mission_id',
        'question_id',
        'user_id',
        'selected_answer',
        'is_correct',
    ];

    public function storeAnswer(Mission $mission, $question, $selectedAnswer)
    {
        return self::create([
            'mission_id' => $mission->id,
            'question_id' => $question->id,
            'user_id' => Auth::id(),
            'selected_answer' => $selectedAnswer,
            'is_correct' => $selectedAnswer === $question->correct_answer,
        ]);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
