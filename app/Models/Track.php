<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function progresses() {
        return $this->hasMany(Progress::class);
    }

    public function performances() {
        return $this->hasMany(Performance::class);
    }

    public function feedbacks() {
        return $this->hasMany(Feedback::class);
    }
}

