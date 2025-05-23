<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Medal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'level',
        'xp_required',
        'condition_type',
        'condition_value',
    ];

    public const CONDITION_TYPES = [
        'xp',
        'level',
        'completed_missions',
        'trail_completed',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_medals')
                    ->withTimestamps()
                    ->withPivot('earned_at');
    }

}
