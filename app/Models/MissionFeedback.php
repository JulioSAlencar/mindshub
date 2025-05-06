<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionFeedback extends Model
{
    protected $fillable = ['user_id', 'mission_id', 'content'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function mission() {
        return $this->belongsTo(Mission::class);
    }

    public function category() {
        return $this->belongsTo(FeedbackCategory::class);
    }

}

