<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionUserStartTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mission_id',
        'started_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
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
