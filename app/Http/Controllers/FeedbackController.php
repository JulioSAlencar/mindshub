<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'student_id' => 'required|exists:users,id',
        'track_id' => 'nullable|exists:tracks,id',
        'comment' => 'required|string|max:1000',
    ]);

    Feedback::create([
        'teacher_id' => auth()->id(),
        'student_id' => $request->student_id,
        'track_id' => $request->track_id,
        'comment' => $request->comment,
    ]);

    return back()->with('success', 'Feedback enviado.');
}

public function showByStudent($studentId)
{
    $feedbacks = Feedback::where('student_id', $studentId)->with(['teacher', 'track'])->get();

    return response()->json($feedbacks);
}

}
