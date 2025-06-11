<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionFeedback extends Model
{
    use HasFactory;

    protected $table = 'mission_feedbacks';

    protected $fillable = [
        'user_id',
        'mission_id',
        'category',
        'content',
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

