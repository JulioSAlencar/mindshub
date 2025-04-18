<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use Illuminate\Http\Request;
use App\Models\RecentDisciplineView;
use App\Models\User;

class DisciplineController extends Controller
{
    public function index()
    {

        $disciplines = Discipline::all();

        return view('disciplines.page', ['disciplines' => $disciplines]);
    }

    public function create()
    {
        $disciplines = Discipline::all();
        return view('disciplines.create', compact('disciplines'));
    }

    public function content()
    {
        $disciplines = Discipline::all();
        return view('disciplines.content', compact('disciplines'));
    }

    public function store(Request $request)
    {

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

        $user = auth()->user();
        $discipline->user_id = $user->id;

        $discipline->save();

        return redirect()->route('disciplines.page')->with('success', 'Disciplina criada com sucesso!');
    }


    public function show($id)
    {
        $discipline = Discipline::findOrFail($id);

        $disciplineOwner = User::where('id', $discipline->user_id)->first()->toArray();

        // Registra ou atualiza a visualização recente
        RecentDisciplineView::updateOrCreate(
            ['user_id' => auth()->id(), 'discipline_id' => $discipline->id],
            ['viewed_at' => now()]
        );

        return view('disciplines.show', ['discipline' => $discipline, 'disciplineOwner' => $disciplineOwner]);
    }

    public function mission()
    {
        $disciplines = Discipline::all();
        return view('disciplines.index', ['disciplines' => $disciplines]);
    }

    public function destroy($id)
    {
        $discipline = Discipline::findOrFail($id);

        if ($discipline->image && file_exists(public_path('assets/disciplines/' . $discipline->image))) {
            unlink(public_path('assets/disciplines/' . $discipline->image));
        }
    
        $discipline->delete();

        return redirect()->route('disciplines.page')->with('msg', 'Disciplina excluída com sucesso!');

    }

    public function edit($id)
    {
        $discipline = Discipline::findOrFail($id);

        return view('disciplines.edit', ['discipline' => $discipline]);

    }
    public function update(Request $request, $id)
    {
        $discipline = Discipline::findOrFail($id);
        $discipline->title = $request->title;
        $discipline->description = $request->description;
        
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            if ($discipline->image && file_exists(public_path('assets/disciplines/' . $discipline->image))) {
                unlink(public_path('assets/disciplines/' . $discipline->image));
            }

            $requestImage = $request->file('image');
            $extension = $requestImage->extension();
        
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
        
            $requestImage->move(public_path('assets/disciplines'), $imageName);
        
            $discipline->image = $imageName;
        }        

        $discipline->save();

        return redirect()->route('disciplines.page')->with('msg', 'Disciplina atualizada com sucesso!');
    }

}
