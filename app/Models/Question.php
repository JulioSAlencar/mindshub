<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    use HasFactory;

    protected $fillable = [
        'statement',
        'correct_answer',
        'explanation',
        'wrong_answers',
    ];

    protected $casts = [
        'wrong_answers' => 'array'
    ];
    
    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }
}
