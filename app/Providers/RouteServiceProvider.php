<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use App\Http\Middleware\HandleTempQuestions;

class RouteServiceProvider extends ServiceProvider
{

    public function boot(): void
    {

        parent::boot();

        $this->app->booted(function () {
            $router = $this->app['router'];
    
            $router->pushMiddlewareToGroup('web', HandleTempQuestions::class);
        });

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->group(base_path('routes/student.php'));

            Route::middleware('web')
                ->group(base_path('routes/teacher.php'));

            Route::middleware('web')
                ->group(base_path('routes/profile.php'));

            Route::middleware('web')
                ->group(base_path('routes/auth.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }
}
