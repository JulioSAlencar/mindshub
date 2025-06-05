@extends('layouts.app')

@section('content')

<div class="p-6 bg-gray-100 min-h-screen">
    <h2 class="text-2xl font-bold mb-4">Conteúdos da Disciplina: {{ $discipline->title }}</h2>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('disciplines.manager', ['id' => $discipline->id])}}"   class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
        Voltar
    </a>
    <a href="{{ route('contents.createForm', ['id' => $discipline->id]) }}"
       class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
        Adicionar Novo Conteúdo
    </a>

    @if($discipline->contents->count())
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-xl shadow">
                <thead>
                    <tr class="bg-gray-50 border-b text-left">
                        <th class="p-4">Título</th>
                        <th class="p-4">Tipo</th>
                        <th class="p-4">Tamanho</th>
                        <th class="p-4">Data de envio</th>
                        <th class="p-4 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($discipline->contents as $content)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4">{{ $content->title }}</td>
                            <td class="p-4">{{ strtoupper($content->file_type) }}</td>
                            <td class="p-4">
                                @if($content->file_size >= 1048576)
                                    {{ number_format($content->file_size / 1048576, 2) }} MB
                                @else
                                    {{ number_format($content->file_size / 1024, 2) }} KB
                                @endif
                            </td>
                            <td class="p-4">{{ $content->created_at->format('d/m/y') }}</td>
                            <td class="p-4 text-center space-x-2">
                                <a href="{{ asset($content->file_path) }}"
                                   class="text-blue-600 hover:underline"
                                   target="_blank">Visualizar</a>
                                <a href="{{ route('contents.updateContents', $content->id) }}"
                                   class="text-yellow-600 hover:underline">Editar</a>

                                <a class="text-green-600 hover:underline" href="{{ url($content->file_path) }}" download>Baixar</a>

                                <form action="{{ route('contents.destroy', $content->id) }}" method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Deseja excluir este conteúdo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="mt-4 text-gray-600">Esta disciplina ainda não possui conteúdos.</p>
    @endif
</div>
@endsection
