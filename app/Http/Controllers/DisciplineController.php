<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Discipline;
use App\Models\Mission;
use App\Models\MissionAnswer;
use App\Models\RecentDisciplineView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DisciplineController extends Controller
{
    public function index()
    {
        if (!Gate::allows('is-teacher')) 
        {
            abort(403, 'Você não é professor >:(');
        }

        $disciplines = Discipline::all();
        return view('disciplines.page', compact('disciplines'));
    }

    public function manager($id)
    {
        if (!Gate::allows('is-teacher')) 
        {
            abort(403, 'Você não é professor >:(');
        }

        $discipline = Discipline::findOrFail($id);
        return view('disciplines.manager', compact('discipline'));

    }

    public function create()
    {
        return view('disciplines.create');
    }

    public function store(Request $request)
    {

        $this->authorize('manage', Discipline::class);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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

        $discipline->creator_id = auth()->id(); // atualizado
        $discipline->save();

        return redirect()->route('disciplines.page')->with('success', 'Disciplina criada com sucesso!');
    }

    public function show($id)
    {
        $discipline = Discipline::findOrFail($id);
        $disciplineOwner = $discipline->creator->toArray(); // atualizado

        if (auth()->check()) {
            RecentDisciplineView::updateOrCreate(
                ['user_id' => auth()->id(), 'discipline_id' => $discipline->id],
                ['viewed_at' => now()]
            );
        }

        return view('disciplines.show', compact('discipline', 'disciplineOwner'));
    }

    public function edit($id)
    {
        $discipline = Discipline::findOrFail($id);
        return view('disciplines.edit', compact('discipline'));
    }

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

    public function destroy($id)
    {
        $discipline = Discipline::findOrFail($id);
        $imagePath = public_path('assets/disciplines/' . $discipline->image);

        if ($discipline->image && file_exists($imagePath)) {
            if (unlink($imagePath)) {
                logger("Imagem {$discipline->image} apagada com sucesso.");
            } else {
                logger("Erro ao apagar a imagem {$discipline->image}.");
            }
        } else {
            logger("Imagem não encontrada em: $imagePath");
        }

        $discipline->delete();

        return redirect()->route('disciplines.page')->with('msg', 'Disciplina excluída com sucesso!');
    }


    public function showContent($id)
    {
        $discipline = Discipline::with('contents')->findOrFail($id);
        $disciplineOwner = $discipline->creator->toArray();

        $missions = Mission::where('discipline_id', $discipline->id)->with('questions')->get();

        $groupedContents = $discipline->contents->groupBy('category');

        $answeredMissionIds = MissionAnswer::whereIn('mission_id', $missions->pluck('id'))
            ->where('user_id', auth()->id())
            ->pluck('mission_id')
            ->toArray();

        return view('disciplines.showContent', compact('discipline', 'disciplineOwner', 'missions', 'answeredMissionIds', 'groupedContents'));
    }



    public function mission($id)
    {
        $discipline = Discipline::findOrFail($id);
        return view('missions.create', compact('discipline'));
    }

    public function joinDiscipline($id)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para se inscrever.');
        }

        $discipline = Discipline::findOrFail($id);

        if ($discipline->creator_id === $user->id) {
            return redirect()->route('disciplines.showContent', ['id' => $discipline->id])->with('error', 'Você não pode se inscrever na sua própria disciplina.');
        }

        if ($user->disciplinesParticipant()->where('discipline_id', $id)->exists()) {
            return redirect()->route('disciplines.showContent', ['id' => $discipline->id])->with('error', 'Você já está inscrito nesta disciplina.');
        }

        $user->disciplinesParticipant()->attach($id);

        return redirect()->route('disciplines.showContent', ['id' => $discipline->id])->with('msg', 'Você se inscreveu na disciplina');
    }

    public function disciplinesParticipant()
    {
        $user = auth()->user();
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para ver suas inscrições.');
        }
    
        $disciplines = $user->disciplinesParticipant; // retorna as disciplinas vinculadas
    
        return view('disciplines.participating', compact('disciplines')); // substitua 'nome_da_view' pelo nome da view que exibirá
    }
}
