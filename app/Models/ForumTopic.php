<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ForumReply;

class ForumTopic extends Model
{
    public function topic()
    {
        return $this->belongsTo(ForumTopic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
