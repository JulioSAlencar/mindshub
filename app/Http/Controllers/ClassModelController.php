<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;

class ClassModelController extends Controller
{
    public function index()
    {
        return ClassModel::with('students')->where('teacher_id', auth()->id())->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:class_rooms',
            'max_students' => 'integer',
        ]);

        return ClassModel::create([
            'teacher_id' => auth()->id(),
            ...$request->only(['name', 'max_students'])
        ]);
    }

    public function update(Request $request, $id)
    {
        $classRoom = ClassModel::where('id', $id)->where('teacher_id', auth()->id())->firstOrFail();

        $classRoom->update($request->only(['name', 'max_students']));

        return response()->json(['message' => 'Atualizado']);
    }

    public function destroy($id)
    {
        $classRoom = ClassModel::where('id', $id)->where('teacher_id', auth()->id())->firstOrFail();
        $classRoom->delete();

        return response()->json(['message' => 'Deletado']);
    }

    public function addStudents(Request $request, $id)
    {
        $request->validate(['student_ids' => 'required|array']);
        $classRoom = ClassModel::findOrFail($id);
        $classRoom->students()->sync($request->student_ids);

        return response()->json(['message' => 'Alunos atualizados']);
    }
}

