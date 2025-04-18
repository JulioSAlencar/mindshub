<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Models\RecentDisciplineView;
use App\Models\User;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    /**
     * Exibe a página principal com todas as disciplinas.
     */
    public function index()
    {
        $disciplines = Discipline::all();
        return view('disciplines.page', compact('disciplines'));
    }

    /**
     * Exibe a página de criação de disciplina.
     */
    public function create()
    {
        return view('disciplines.create');
    }

    /**
     * Armazena uma nova disciplina no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $discipline = new Discipline();
        $discipline->title = $request->title;
        $discipline->description = $request->description;

        // Upload de imagem
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imageName = md5($request->file('image')->getClientOriginalName() . strtotime("now")) . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('assets/disciplines'), $imageName);
            $discipline->image = $imageName;
        }

        $discipline->user_id = auth()->id();
        $discipline->save();

        return redirect()->route('disciplines.page')->with('success', 'Disciplina criada com sucesso!');
    }

    /**
     * Exibe uma disciplina específica.
     */
    public function show($id)
    {
        $discipline = Discipline::findOrFail($id);
        $disciplineOwner = User::find($discipline->user_id)->toArray();

        if (auth()->check()) {
            RecentDisciplineView::updateOrCreate(
                ['user_id' => auth()->id(), 'discipline_id' => $discipline->id],
                ['viewed_at' => now()]
            );
        }

        return view('disciplines.show', compact('discipline', 'disciplineOwner'));
    }

    /**
     * Exibe a página de edição de disciplina.
     */
    public function edit($id)
    {
        $discipline = Discipline::findOrFail($id);
        return view('disciplines.edit', compact('discipline'));
    }

    /**
     * Atualiza uma disciplina existente.
     */
    public function update(Request $request, $id)
    {
        $discipline = Discipline::findOrFail($id);
        $discipline->title = $request->title;
        $discipline->description = $request->description;

        // Atualiza imagem se houver nova
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($discipline->image && file_exists(public_path('assets/disciplines/' . $discipline->image))) {
                unlink(public_path('assets/disciplines/' . $discipline->image));
            }

            $imageName = md5($request->file('image')->getClientOriginalName() . strtotime("now")) . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('assets/disciplines'), $imageName);
            $discipline->image = $imageName;
        }

        $discipline->save();

        return redirect()->route('disciplines.page')->with('msg', 'Disciplina atualizada com sucesso!');
    }

    /**
     * Remove uma disciplina.
     */
    public function destroy($id)
    {
        $discipline = Discipline::findOrFail($id);

        if ($discipline->image && file_exists(public_path('assets/disciplines/' . $discipline->image))) {
            unlink(public_path('assets/disciplines/' . $discipline->image));
        }

        $discipline->delete();

        return redirect()->route('disciplines.page')->with('msg', 'Disciplina excluída com sucesso!');
    }

    /**
     * Exibe a página de conteúdos.
     */
    public function content()
    {
        $disciplines = Discipline::all();
        return view('disciplines.content', compact('disciplines'));
    }

    /**
     * Exibe uma página alternativa (ex: missão, valores).
     */
    public function mission()
    {
        $disciplines = Discipline::all();
        return view('disciplines.index', compact('disciplines'));
    }

    /**
     * Inscreve o usuário na disciplina.
     */
    public function joinDiscipline($id)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para se inscrever.');
        }

        $discipline = Discipline::findOrFail($id);

        if ($discipline->user_id === $user->id) {
            return redirect()->route('disciplines.content')->with('error', 'Você não pode se inscrever na sua própria disciplina.');
        }
    
        if ($user->disciplinesParticipant()->where('discipline_id', $id)->exists()) {
            return redirect()->route('disciplines.content')->with('error', 'Você já está inscrito nesta disciplina.');
        }

        $user->disciplinesParticipant()->attach($id);

        return redirect()->route('disciplines.content')->with('msg', 'Você se inscreveu na disciplina');
    }
}