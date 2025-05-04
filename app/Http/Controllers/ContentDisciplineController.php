<?php

namespace App\Http\Controllers;

use App\Models\ContentDiscipline;
use App\Models\Discipline;
use Illuminate\Http\Request;

class ContentDisciplineController extends Controller
{
    public function index($id){
        $discipline = Discipline::findOrfail($id);
        return view('disciplines.addContents', compact('discipline'));
    }

    public function store(Request $request, $disciplineId)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg',
        ]);

        $file = $request->file('file');
        $fileSize = $file->getSize(); 

        $destinationPath = public_path('assets/contents');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);

        
        ContentDiscipline::create([
            'discipline_id' => $disciplineId,
            'title' => $request->title,
            'file_path' => 'assets/contents/' . $filename,
            'file_type' => $file->getClientOriginalExtension(),
            'file_size' => $fileSize,
        ]);

        return redirect()->route('disciplines.content', ['id' => $disciplineId])
                     ->with('success', 'Conteúdo adicionado com sucesso!');

    }

}
