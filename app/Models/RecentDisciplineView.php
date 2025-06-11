<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecentDisciplineView extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id', 'discipline_id', 'viewed_at'];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
