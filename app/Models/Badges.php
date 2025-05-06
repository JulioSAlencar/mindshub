<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badges extends Model
{
    protected $fillable = ['name', 'description', 'icon'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_badges')->withTimestamps();
    }
}