<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\User;

class EvaluationController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'student_id' => 'required|exists:users,id',
        'xp' => 'nullable|integer|min:0',
        'medal' => 'nullable|string|max:255',
        'comment' => 'nullable|string',
    ]);

    Evaluation::create([
        'teacher_id' => auth()->id(),
        'student_id' => $request->student_id,
        'xp' => $request->xp ?? 0,
        'medal' => $request->medal,
        'comment' => $request->comment,
    ]);

    $student = User::find($request->student_id);
    $student->xp += $request->xp;
    $student->save();

    return back()->with('success', 'Avaliação registrada com sucesso.');
}

}
