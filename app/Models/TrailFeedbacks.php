<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Trail;

class TrailFeedbacks extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trail_id',
        'content',
    ];

    /**
     * Feedback belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Feedback belongs to a trail.
     */
    public function trail()
    {
        return $this->belongsTo(Trail::class);
    }
}