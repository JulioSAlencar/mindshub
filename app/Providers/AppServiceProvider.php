<?php

namespace App\Providers;

use App\Models\Discipline;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Gate::define('is-student', fn ($user) => $user->role === 'student');

        Gate::define('is-teacher', fn ($user) => $user->role === 'teacher');

        Gate::define('is-subscribed', function (User $user, Discipline $discipline) {
            return $discipline->users->contains($user->id);
        });
        
        Gate::define('is-creator', function ($user, Discipline $discipline) {
            return $discipline->creator_id === $user->id;
        });
    }
}
