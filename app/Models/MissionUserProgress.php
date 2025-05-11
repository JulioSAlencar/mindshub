<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionUserProgress extends Model
{
    protected $table = 'mission_user_progress';

    protected $fillable = [
        'user_id',
        'mission_id',
        'progress',
        'time_remaining',
        'last_paused_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }
}
