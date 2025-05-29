<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumReplyReport extends Model
{
    protected $fillable = ['user_id', 'reply_id', 'reason'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reply()
    {
        return $this->belongsTo(ForumReply::class, 'reply_id');
    }
}
