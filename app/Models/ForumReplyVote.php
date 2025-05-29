<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumReplyVote extends Model
{
    protected $fillable = ['user_id', 'forum_reply_id', 'is_upvote'];

    public function reply()
    {
        return $this->belongsTo(ForumReply::class, 'forum_reply_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}