@extends('layouts.app')

@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        {{-- Informações do perfil --}}
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white shadow rounded-lg p-6">
                <img src="{{ $user->profile_photo ? asset($user->profile_photo) : asset('assets/profile_photos/default.png') }}" class="w-48 h-48 object-cover rounded-full mx-auto mb-4" />
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Atualização de senha --}}
            <div class="bg-white shadow rounded-lg p-6">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- Exclusão de conta --}}
        <div class="bg-white shadow border border-red-500 rounded-lg p-6 flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold text-red-600">Excluir Conta</h2>
                <p class="text-sm text-gray-600">Ao excluir sua conta, seus dados serão apagados permanentemente após 90 dias.</p>
            </div>
            <button onclick="openModal()" class="px-4 py-2 border border-red-600 text-red-600 rounded hover:bg-red-100">
                Excluir Conta
            </button>
        </div>
    </div>
</div>

{{-- Modal de confirmação --}}
<div id="confirmModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden justify-center items-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h3 class="text-lg font-semibold text-red-600">Confirmar Exclusão</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <p class="text-sm text-gray-700 mb-4">
            Tem certeza que deseja excluir sua conta? Sua conta ficará em standby por 90 dias e, após esse período, será permanentemente apagada.
        </p>
        <p class="text-sm text-gray-700 mb-4">
            <strong>Atenção: </strong>Se você fizer login novamente dentro desses 90 dias, a exclusão será cancelada automaticamente.
        </p>
        <div class="flex justify-end space-x-2">
            <form method="POST" action="{{ route('account.delete') }}">
                @csrf
                <input type="hidden" name="confirm_delete" value="1">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Confirmar</button>
            </form>
            <button onclick="closeModal()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">Cancelar</button>
        </div>
    </div>
</div>

{{-- Script para abrir/fechar modal --}}
<script>
    function openModal() {
        document.getElementById('confirmModal').classList.remove('hidden');
        document.getElementById('confirmModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('confirmModal').classList.add('hidden');
        document.getElementById('confirmModal').classList.remove('flex');
    }
</script>
@endsection
