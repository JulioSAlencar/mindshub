@extends('layouts.app')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <!-- Título -->
    <div class="flex items-center mb-6">
        <i class="fas fa-book text-2xl text-blue-600 mr-3"></i>
        <h1 class="text-2xl font-bold">Historico de Materiais</h1>
    </div>

    <!-- Cards de Status -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <!-- Total de Materiais -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-xl shadow text-center">
            <p class="text-3xl font-bold">247</p>
            <p>Total de Materiais</p>
        </div>


        <!-- Enviados -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-xl shadow text-center">
            <p class="text-3xl font-bold">198</p>
            <p>Enviados</p>
        </div>

        <!-- Pendentes -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-xl shadow text-center">
            <p class="text-3xl font-bold">32</p>
            <p>Pendentes</p>
        </div>

        <!-- Falharam -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-xl shadow text-center">
            <p class="text-3xl font-bold">17</p>
            <p>Falharam</p>
        </div>
    </div>

    <!-- Lista de Materiais -->
    <div class="space-y-6">
        <!-- Item 1 -->
        <div class="bg-white rounded-xl shadow p-6 relative">
            <!-- status -->
            <span class="absolute top-4 right-4 bg-green-200 text-green-800 text-xs font-bold px-3 py-1 rounded-full">ENVIADO</span>
            <h2 class="text-lg font-semibold mb-2">Relatório Mensal - Janeiro 2024</h2>
            <span class="inline-block bg-red-200 text-red-800 text-xs font-bold px-2 py-1 rounded-full mb-2">PDF</span>
            <p class="text-sm text-gray-700 mb-4">
                Relatório completo das atividades e métricas do mês de janeiro, incluindo análises de performances e projeções.
            </p>
            <div class="flex space-x-3">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center text-sm">
                    <i class="fas fa-eye mr-2"></i> Visualizar
                </button>
                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded flex items-center text-sm">
                    <i class="fas fa-times mr-2"></i> Excluir
                </button>
            </div>
        </div>

        <!-- Item 2 -->
        <div class="bg-white rounded-xl shadow p-6 relative">
            <span class="absolute top-4 right-4 bg-green-200 text-green-800 text-xs font-bold px-3 py-1 rounded-full">ENVIADO</span>
            <h2 class="text-lg font-semibold mb-2">Gráfico Básicos</h2>
            <span class="inline-block bg-blue-200 text-blue-800 text-xs font-bold px-2 py-1 rounded-full mb-2">DOCUMENTO</span>
            <p class="text-sm text-gray-700 mb-4">
                Visualização gráfica dos resultados de vendas do primeiro trimestre com comparações anuais.
            </p>
            <div class="flex space-x-3">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center text-sm">
                    <i class="fas fa-eye mr-2"></i> Visualizar
                </button>
                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded flex items-center text-sm">
                    <i class="fas fa-times mr-2"></i> Excluir
                </button>
            </div>
        </div>

        <!-- Item 3 -->
        <div class="bg-white rounded-xl shadow p-6 relative">
            <span class="absolute top-4 right-4 bg-green-200 text-green-800 text-xs font-bold px-3 py-1 rounded-full">ENVIADO</span>
            <h2 class="text-lg font-semibold mb-2">Treinamento Segurança</h2>
            <span class="inline-block bg-purple-200 text-purple-800 text-xs font-bold px-2 py-1 rounded-full mb-2">VIDEO</span>
            <p class="text-sm text-gray-700 mb-4">
                Visualização gráfica dos resultados de vendas do primeiro trimestre com comparações anuais.
            </p>
            <div class="flex space-x-3">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center text-sm">
                    <i class="fas fa-eye mr-2"></i> Visualizar
                </button>
                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded flex items-center text-sm">
                    <i class="fas fa-times mr-2"></i> Excluir
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Comentários para dinamizar com backend -->
{{--
@foreach ($materiais as $material)
    <div class="...">
        <h2>{{ $material->titulo }}</h2>
<span>{{ $material->tipo }}</span>
<p>{{ $material->descricao }}</p>
<span>{{ $material->status }}</span>
<a href="{{ route('materiais.show', $material->id) }}">Visualizar</a>
<form action="{{ route('materiais.destroy', $material->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Excluir</button>
</form>
</div>
@endforeach
--}}
@endsection