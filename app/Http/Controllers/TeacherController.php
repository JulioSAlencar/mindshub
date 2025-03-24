<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function dashboard()
    {
        return view('teacher.dashboard');
    }

<<<<<<< Updated upstream
    public function portal()
    {
        return view('teacher.portal_teacher');
=======
    public function disciplines()
    {
        return view('teacher.disciplines');
>>>>>>> Stashed changes
    }
}
