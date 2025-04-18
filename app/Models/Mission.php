<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'discipline_id',
        'statement',
        'correct_answer',
        'explanation',
        'wrong_answers',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'wrong_answers' => 'array',
    ];

    // Se uma missão pertence a uma disciplina
    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }
}
