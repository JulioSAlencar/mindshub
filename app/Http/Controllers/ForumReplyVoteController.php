<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumReplyVote;
use App\Models\ForumReply;

class ForumReplyVoteController extends Controller
{
    public function vote(Request $request, $replyId)
    {
        $request->validate([
            'is_upvote' => 'required|boolean',
        ]);

        $vote = ForumReplyVote::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'forum_reply_id' => $replyId,
            ],
            [
                'is_upvote' => $request->is_upvote,
            ]
        );

        return back()->with('success', 'Voto registrado com sucesso.');
    }
}
