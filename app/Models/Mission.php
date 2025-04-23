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
}
