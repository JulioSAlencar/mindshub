@extends('layouts.app')

@section('title', 'Gerenciador')

@section('content')

<div class="max-w-4xl mx-auto mt-10 px-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Página de Gerenciamento de <span class="text-blue-600 justify-center">{{ $discipline->title }}</span>
    </h1>

    @can("is-teacher")
    <nav class="bg-white p-6 rounded-xl shadow-md space-y-6">
        <a href="{{ route('disciplines.showContent', ['id' => $discipline->id]) }}"
        class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg">Voltar</a>
        <div class="space-y-2">
                <label class="block text-gray-700 font-semibold">Gerenciar Conteúdos</label>  
                <a href="{{ route('contents.createForm', ['id' => $discipline->id]) }}"
                   x-show="tab === 'conteudo'" 
                   class="inline-block bg-blue-600 hover:bg-blue-800 text-white font-medium py-2 px-4 rounded transition">
                    Adicionar Conteúdo
                </a>
                <a href="{{ route('contents.view', $discipline->id) }}"
                   x-show="tab === 'conteudo'" 
                   class="inline-block bg-blue-600 hover:bg-blue-800 text-white font-medium py-2 px-4 rounded transition">
                    Ver Conteúdo
                </a>
            </div>
            
            <div class="space-y-2">
                <label class="block text-gray-700 font-semibold">Gerenciar Missões</label>
                <div class="flex gap-4 flex-wrap">
                    <a href="{{ route('missions.create', $discipline->id) }}"
                       x-show="tab === 'missoes'" 
                       class="bg-green-600 hover:bg-green-800 text-white font-medium py-2 px-4 rounded transition">
                        Criar Missão
                    </a>
                    <a href="{{ route('missions.index', $discipline->id) }}"
                       x-show="tab === 'missoes'" 
                        class="bg-green-600 hover:bg-green-800 text-white font-medium py-2 px-4 rounded transition">
                        Gerenciar Missões
                    </a>
                </div>
            </div>
            
            <div class="space-y-2">
                <label class="block text-gray-700 font-semibold">Gerenciar Alunos</label>
                <div class="flex gap-4 flex-wrap">
                    <a href="{{ route('disciplines.showStudents', $discipline->id) }}"
                       x-show="tab === 'missoes'" 
                       class="bg-blue-600 hover:bg-blue-800 text-white font-medium py-2 px-4 rounded transition">
                        Alunos da disciplina
                    </a>
                </div>
            </div>
            <div x-data="{ open: false, isCompleted: {{ $discipline->is_completed ? 'true' : 'false' }} }">
                <!-- Botão que abre o popup -->
                <button 
                    @click="open = true"
                    type="button"
                    :class="isCompleted 
                        ? 'bg-green-600 hover:bg-green-800' 
                        : 'bg-red-600 hover:bg-red-800'"
                    class="text-white font-medium py-2 px-4 rounded transition"
                    x-text="isCompleted ? 'Desfazer Conclusão' : 'Concluir Disciplina'"
                ></button>

                <!-- Modal de confirmação -->
                <div 
                    x-show="open"
                    x-transition
                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                >
                    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
                        <h2 class="text-lg font-semibold mb-4 text-gray-800" 
                            x-text="isCompleted 
                                ? 'Tem certeza que deseja desfazer a conclusão desta disciplina?' 
                                : 'Tem certeza que deseja concluir esta disciplina?'">
                        </h2>

                        <div class="flex justify-end space-x-4">
                            <!-- Cancelar -->
                            <button 
                                @click="open = false"
                                type="button"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition"
                            >
                                Cancelar
                            </button>

                            <!-- Confirmar -->
                            <form 
                                method="POST" 
                                :action="isCompleted 
                                    ? '{{ route('disciplines.undo', $discipline->id) }}' 
                                    : '{{ route('disciplines.complete', $discipline->id) }}'"
                            >
                                @csrf
                                @method('PATCH')
                                <button
                                    type="submit"
                                    :class="isCompleted 
                                        ? 'bg-green-600 hover:bg-green-700' 
                                        : 'bg-red-600 hover:bg-red-700'"
                                    class="px-4 py-2 text-white rounded transition"
                                    x-text="isCompleted ? 'Desfazer' : 'Concluir'"
                                ></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <a href="{{ route('disciplines.edit', $discipline->id) }}"
                   class="bg-gray-700 hover:bg-gray-900 text-white font-medium py-2 px-4 rounded transition">
                    Configurações da Disciplina
                </a>
            </div>
        </nav>
    @endcan
</div>

@endsection
