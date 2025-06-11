<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_id', 'student_id', 'track_id', 'comment'];

    public function teacher() { return $this->belongsTo(User::class, 'teacher_id'); }
    public function student() { return $this->belongsTo(User::class, 'student_id'); }
    public function track() { return $this->belongsTo(Track::class); }
}

