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

public function updateTopic(Request $request, $topicId) 
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    $topic = ForumTopic::findOrFail($topicId);

    if ($topic->user_id !== auth()->id()) {
        abort(403, 'Acesso não autorizado.');
    }

    $topic->update([
        'title' => $request->title,
        'content' => $request->content,
    ]);

    return back()->with('success', 'Tópico atualizado com sucesso!');
}

public function destroyTopic($id)
{
    $topic = ForumTopic::findOrFail($id);

    if ($topic->user_id !== auth()->id()) {
        abort(403, 'Acesso negado.');
    }

    $topic->delete();

    return redirect()->route('forum.index')->with('success', 'Tópico deletado.');
}

public function updateReply(Request $request, $id)
{
    $request->validate([
        'body' => 'required|string'
    ]);

    $reply = ForumReply::findOrFail($id);

    if ($reply->user_id !== auth()->id()) {
        abort(403, 'Sem permissão');
    }

    $reply->body = $request->body;
    $reply->save();

    return back()->with('success', 'Resposta editada.');
}

public function destroyReply($id)
{
    $reply = ForumReply::findOrFail($id);

    if ($reply->user_id !== auth()->id()) {
        abort(403, 'Sem permissão');
    }

    $reply->delete();

    return back()->with('success', 'Resposta excluída.');
}
public function toggleConstructive($id)
{
    $reply = ForumReply::findOrFail($id);

    if (!auth()->user()->isProfessor()) {
        abort(403, 'Apenas professores podem fazer isso.');
    }

    $reply->is_constructive = !$reply->is_constructive;
    $reply->save();

    return back()->with('success', 'Resposta atualizada com sucesso.');
}

public function likeReply($id)
{
    $reply = ForumReply::findOrFail($id);
    $reply->increment('likes');
    return back();
}

}
