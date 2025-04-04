<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <br>

                    <a href="{{ route('disciplines.page') }}" class="btn btn-success">Ver Disciplinas</a>

                    @can('is-student')
                        <p>professores não podem ver isso</p>
                    @else
                        <p>Alunos não podem ver isso</p>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
