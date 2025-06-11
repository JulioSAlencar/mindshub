<?php

namespace App\Http\Controllers;

use App\Models\PerformanceMetric;
use Illuminate\Http\Request;

class PerformanceMetricController extends Controller
{
    public function index()
    {
        return PerformanceMetric::where('user_id', auth()->id())->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'track_id' => 'required|exists:tracks,id',
            'area' => 'required|string',
            'accuracy' => 'numeric',
            'average_time' => 'integer',
            'completion_rate' => 'numeric',
        ]);

        return PerformanceMetric::create([
            'user_id' => auth()->id(),
            ...$request->only(['track_id', 'area', 'accuracy', 'average_time', 'completion_rate'])
        ]);
    }

    public function update(Request $request, $id)
    {
        $metric = PerformanceMetric::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $metric->update($request->only(['accuracy', 'average_time', 'completion_rate']));

        return response()->json(['message' => 'Atualizado com sucesso']);
    }
}

