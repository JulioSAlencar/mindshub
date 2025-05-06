<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;

class ContentController extends Controller
{
    public function approve($id)
{
    $content = Content::findOrFail($id);
    $content->status = 'approved';
    $content->save();

    return response()->json(['message' => 'Content approved']);
}

public function update(Request $request, $id)
{
    $content = Content::findOrFail($id);
    $content->update($request->only(['title', 'body']));
    return response()->json($content);
}

public function destroy($id)
{
    Content::findOrFail($id)->delete();
    return response()->json(['message' => 'Content deleted']);
}

}
