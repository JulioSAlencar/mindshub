@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="goback">
        <a href="{{ route('disciplines.showContent', $discipline->id) }}">
            <button x-show="tab === 'missoes'"
                class="bg-blue-600 text-white text-lg py-3 px-6 rounded-md hover:bg-blue-800 transition">
                voltar
            </button>
        </a>
    </div>
    
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
        
        <h2 class="text-2xl font-bold mb-6">Criar Nova Missão</h2>
        
        <form action="{{ route('missions.store') }}" method="POST">
            @csrf
        
            <!-- Campo oculto para disciplina -->
            <input type="hidden" name="discipline_id" value="{{ $discipline->id }}">
        
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Disciplina: {{ $discipline->title }}</label>
            </div>
        
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Título da Missão</label>
                <input type="text" name="title" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 mb-2">Data de Início</label>
                    <input type="datetime-local" name="start_date" required
                        min="{{ \Carbon\Carbon::now(config('app.timezone'))->format('Y-m-d\TH:i') }}"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2">Data de Término</label>
                    <input type="datetime-local" name="end_date" required
                        min="{{ \Carbon\Carbon::now(config('app.timezone'))->format('Y-m-d\TH:i') }}"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Tempo para concluir a missão (em minutos)</label>
                    <input type="number" name="duration_minutes" min="1"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Ex: 90 para 1h30min">
                </div>
            </div>
        
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                Próximo → Criar Questões
            </button>
        </form>       
    </div>
</div>
@endsection