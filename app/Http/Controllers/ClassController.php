<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;

class ClassController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:classes',
            'student_limit' => 'required|integer|min:1|max:100'

        ]);

        return ClassModel::create($validated);
    }
}
