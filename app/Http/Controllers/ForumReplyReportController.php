<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumReplyReport;

class ForumReplyReportController extends Controller
{
    public function store(Request $request, $replyId)
    {
        $request->validate(['reason' => 'nullable|string|max:255']);

        ForumReplyReport::create([
            'user_id' => auth()->id(),
            'reply_id' => $replyId,
            'reason' => $request->reason,
        ]);

        return back()->with('success', 'Comentário denunciado com sucesso.');
    }

    public function reportReply(Request $request, $id)
{
    $request->validate(['reason' => 'nullable|string|max:255']);

    ForumReplyReport::create([
        'user_id' => auth()->id(),
        'reply_id' => $id,
        'reason' => $request->reason,
    ]);

    return back()->with('success', 'Comentário denunciado com sucesso.');
}
}
// Compare this snippet from app/Http/Controllers/ForumReplyReportController.php:
