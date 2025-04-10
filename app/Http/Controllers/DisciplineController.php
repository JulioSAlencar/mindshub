<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    public function index() {
        $disciplines = Discipline::all();
        return view('disciplines.page', ['disciplines' => $disciplines]);
    }

    public function create(){
        $disciplines = Discipline::all();
        return view('disciplines.create', compact('disciplines'));
    }

    public function store(Request $request){

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $discipline = new Discipline;
        $discipline->title = $request->title;
        $discipline->description = $request->description;

        // imagem upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->file('image');

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('assets/disciplines'), $imageName);

            $discipline->image = $imageName;
        }

        $discipline->save();

        return redirect('disciplines.page?msg=' . urlencode('Disciplina criada com sucesso!'));

    }

    public function show($id) {
        $discipline = Discipline::findOrFail($id);
        return view('disciplines.show', ['discipline' => $discipline]);
    }

    public function mission() {
        $disciplines = Discipline::all();
        return view('disciplines.index', ['disciplines' => $disciplines]);
    }

}
