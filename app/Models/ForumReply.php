<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumReply extends Model
{

    use HasFactory;

    protected $fillable = ['forum_topic_id', 'user_id', 'content', 'is_constructive'];

    public function topic()
    {
        return $this->belongsTo(ForumTopic::class, 'forum_topic_id');
    }

    public function replies()
    {
        return $this->hasMany(ForumReply::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
{
    return $this->belongsTo(ForumReply::class, 'parent_id');
}

public function children()
{
    return $this->hasMany(ForumReply::class, 'parent_id');
}
}
