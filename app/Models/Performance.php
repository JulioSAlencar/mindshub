<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'track_id', 'mission_score', 'practical_score', 'overall_score'];

    public function user() { return $this->belongsTo(User::class); }
    public function track() { return $this->belongsTo(Track::class); }
}

