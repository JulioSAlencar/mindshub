<?php

namespace App\Http\Controllers;

use App\Models\ContentDiscipline;
use App\Models\Discipline;
use Illuminate\Http\Request;

class ContentDisciplineController extends Controller
{
    // Mostrar formulário de adição de conteúdo à disciplina
    public function index($id)
    {
        $discipline = Discipline::findOrFail($id);
        return view('contents.addContents', compact('discipline'));

    }

    // Armazenar novo conteúdo
    public function store(Request $request, $disciplineId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg',
            'category' => 'required|string|in:teoria,resumo,revisao,exercicio,prova',
        ]);

        $file = $request->file('file');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('assets/contents');
        $file->move($destinationPath, $filename);

        ContentDiscipline::create([
            'discipline_id' => $disciplineId,
            'title' => $request->title,
            'file_path' => 'assets/contents/' . $filename,
            'file_type' => $file->getClientOriginalExtension(),
            'file_size' => filesize(public_path('assets/contents/' . $filename)),
            'category' => $request->category,
        ]);

        return redirect()->route('contents.view', ['id' => $disciplineId])
                         ->with('success', 'Conteúdo adicionado com sucesso!');
    }

   //gerenciador de conteudo
    public function showContents($id)
    {
        $discipline = Discipline::with('contents')->findOrFail($id);
        return view('contents.viewContents', compact('discipline'));
    }

    public function editContent($id)
    {
        $content = ContentDiscipline::findOrFail($id);
        $discipline = Discipline::findOrFail($content->discipline_id);
        return view('contents.updateContents', compact('content','discipline'));
    }

    // Atualizar conteúdo
    public function update(Request $request, $id)
    {
        $content = ContentDiscipline::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg',
            'category' => 'required|string|in:teoria,resumo,revisao,exercicio,prova',
        ]);

        if ($request->hasFile('file')) {
            // Deletar arquivo antigo se existir
            if ($content->file_path && file_exists(public_path($content->file_path))) {
                unlink(public_path($content->file_path));
            }

            $file = $request->file('file');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('assets/contents');
        
            // Pegue o tamanho antes de mover
            $fileSize = $file->getSize();
            $fileType = $file->getClientOriginalExtension();
        
            $file->move($destinationPath, $filename);
        
            $content->file_path = 'assets/contents/' . $filename;
            $content->file_size = $fileSize;
            $content->file_type = $fileType;
        }

        $content->title = $request->title;
        $content->category = $request->category;
        $content->save();

        return redirect()->route('contents.view', ['id' => $content->discipline_id])
                         ->with('success', 'Conteúdo atualizado com sucesso!');
    }

    // Excluir conteúdo
    public function destroy($id)
    {
        $content = ContentDiscipline::findOrFail($id);

        // Deletar arquivo relacionado
        if ($content->file_path && file_exists(public_path($content->file_path))) {
            unlink(public_path($content->file_path));
        }

        $content = ContentDiscipline::findOrFail($id);
        $content->delete();

        return redirect()->route('contents.view', ['id' => $content->discipline_id])
                         ->with('success', 'Conteúdo excluído com sucesso!');
    }
}
