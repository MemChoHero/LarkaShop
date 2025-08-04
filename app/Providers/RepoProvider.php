<?php

namespace App\Providers;

use App\Repositories\Interfaces\IUserRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepoProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, function ($app) {
            return new UserRepository();
        });
    }
}
