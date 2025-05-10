<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumReply extends Model
{
    public function replies()
    {
        return $this->hasMany(ForumReply::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
