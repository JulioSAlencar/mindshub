<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use Illuminate\Http\Request;

class DisciplineStudentController extends Controller
{

    public function showStudents($id)
    {
        $discipline = Discipline::with('students')->findOrFail($id);
        return view('disciplines.showStudents', compact('discipline'));
    }

}
