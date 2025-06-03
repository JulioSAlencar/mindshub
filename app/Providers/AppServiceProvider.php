<?php

namespace App\Providers;

use App\Models\Discipline;
use App\Models\User;
use App\Observers\UserObserver;
use App\Services\UserRewardService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(UserRewardService::class, function ($app) {
            return new UserRewardService();
        });
    }

    public function boot(): void
    {
        Gate::define('is-student', fn ($user) => $user->role === 'student');

        Gate::define('is-teacher', fn ($user) => $user->role === 'teacher');

        Gate::define('is-student-or-teacher', function ($user) {
            return in_array($user->role, ['student', 'teacher']);
        });

        Gate::define('is-subscribed', function (User $user, Discipline $discipline) {
            return $discipline->users->contains($user->id);
        });
        
        Gate::define('is-creator', function ($user, Discipline $discipline) {
            return $discipline->creator_id === $user->id;
        });

        User::observe(UserObserver::class);

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $view->with('unreadNotifications', Auth::user()->unreadNotifications);
            } else {
                $view->with('unreadNotifications', collect());
            }
        });
        
    }
}
