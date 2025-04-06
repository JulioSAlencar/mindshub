<?php

namespace App\Providers;

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
    }
}
