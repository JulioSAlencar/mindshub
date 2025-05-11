<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'track_id', 'area', 'accuracy', 'average_time', 'completion_rate'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function track() {
        return $this->belongsTo(Track::class);
    }
}
