<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionComment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'lesson_id', 'comment'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function lesson() {
        return $this->belongsTo(Mission::class);
    }    
}
