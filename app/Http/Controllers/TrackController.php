<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;

class TrackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);
    
        Track::create($request->only(['title', 'description']));
    
        return redirect()->back()->with('success', 'Trilha criada com sucesso.');
    }
    
    public function filter(Request $request)
{
    $query = Track::query();

    if ($request->has('difficulty')) {
        $query->where('difficulty', $request->difficulty);
    }

    if ($request->has('area')) {
        $query->where('area', $request->area);
    }

    return response()->json($query->get());
}
}
