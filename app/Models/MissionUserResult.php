<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionUserResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mission_id',
        'score',
        'xp',
    ];

    // Relacionamento com o usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento com a missão
    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

}
