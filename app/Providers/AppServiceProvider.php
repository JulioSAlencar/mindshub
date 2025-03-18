<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('is-teacher', function (User $user) {
            return $user->role === 'teacher';
        });

        // Define o gate para aluno
        Gate::define('is-student', function (User $user) {
            return $user->role === 'student';
        });

        // Gate para ações específicas de professor
        Gate::define('manage-courses', function (User $user) {
            return $user->role === 'teacher';
        });
    }
}
