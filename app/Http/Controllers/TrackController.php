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
    
}
