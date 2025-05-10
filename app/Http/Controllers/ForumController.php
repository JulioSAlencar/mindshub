<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumTopic;
use App\Models\ForumReply;

class ForumController extends Controller
{
    public function createTopic(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    return ForumTopic::create([
        'user_id' => auth()->id(),
        ...$data
    ]);
}

public function replyToTopic(Request $request, $topicId)
{
    $data = $request->validate(['content' => 'required|string']);

    return ForumReply::create([
        'user_id' => auth()->id(),
        'topic_id' => $topicId,
        'content' => $data['content'],
    ]);
}

}
