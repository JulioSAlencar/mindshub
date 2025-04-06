<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'discpline_id',
        'statement',
        'correct_answer',
        'explanation',
        'wrong_answers',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'wrong_answers' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    /**
     * Relacionamento com a disciplina.
     */
    public function discipline() {
        return $this->belongsTo(Discipline::class);
    }

    /**
     * Acessor para verificar se a missão está ativa (dentro do prazo).
     */
    public function getIsActiveAttribute() {
        $now = now();
        return $this->start_date <= $now && $this->end_date >= $now;
    }

    public function scopeActive($query) {
        $now = now();
        return $query->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now);
    }
}
