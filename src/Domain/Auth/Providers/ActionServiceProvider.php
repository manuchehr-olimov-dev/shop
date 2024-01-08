<?php

namespace Domain\Auth\Providers;

// use Illuminate\Support\Facades\Gate;
use Domain\Auth\Actions\RegisterNewUserAction;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    public array $bindings = [
            RegisterNewUserAction::class => RegisterNewUserAction::class
    ];
}
