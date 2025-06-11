<?php

namespace App\Http\Controllers;

use App\Models\MissionComment;
use Illuminate\Http\Request;

class MissionCommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'comment' => 'required|string|max:1000',
        ]);

        MissionComment::create([
            'user_id' => auth()->id(),
            'lesson_id' => $request->lesson_id,
            'comment' => $request->comment
        ]);

        return response()->json(['message' => 'Comentário enviado!']);
    }

    public function update(Request $request, $id)
    {
        $comment = MissionComment::findOrFail($id);
        $this->authorize('update', $comment);

        $request->validate(['comment' => 'required|string|max:1000']);
        $comment->update(['comment' => $request->comment]);

        return response()->json(['message' => 'Atualizado!']);
    }

    public function destroy($id)
    {
        $comment = MissionComment::findOrFail($id);
        $this->authorize('delete', $comment);
        $comment->delete();

        return response()->json(['message' => 'Deletado.']);
    }
}
