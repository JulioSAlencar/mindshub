@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

@section('content')
<body>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-dark">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    
    <div class="py-4">
        <div class="container">
            <div class="row g-4">
    
                {{-- Informações do perfil --}}
                <div class="col-12 col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <img src="{{ $user->profile_photo ? asset($user->profile_photo) : asset('assets/profile_photos/default.png') }}" style="width: 200px; height: 200px;" />

                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>
    
                {{-- Atualização de senha --}}
                <div class="col-12 col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
    
                {{-- Exclusão de conta --}}
                <div class="col-12">
                    <div class="card shadow border-danger">
                        <div class="card-body">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </div>    
</body>
@endsection