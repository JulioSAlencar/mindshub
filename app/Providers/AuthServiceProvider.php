<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Discipline;
use App\Policies\DisciplinePolicy;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        Discipline::class => DisciplinePolicy::class,
    ];
}