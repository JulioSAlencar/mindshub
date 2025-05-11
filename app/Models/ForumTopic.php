<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ForumReply;

class ForumTopic extends Model
{

    use HasFactory;

    protected $fillable = ['user_id', 'title', 'content'];

    public function replies()
    {
        return $this->hasMany(ForumReply::class);
    }

    public function topic()
    {
        return $this->belongsTo(ForumTopic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
