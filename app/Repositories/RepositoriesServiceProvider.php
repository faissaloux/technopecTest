<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class repositoriesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\ProductRepositoryInterface',
            'App\Repositories\ProductRepository'
        );

        $this->app->bind(
            'App\Repositories\ColorRepositoryInterface',
            'App\Repositories\ColorRepository'
        );

        $this->app->bind(
            'App\Repositories\MaterialRepositoryInterface',
            'App\Repositories\MaterialRepository'
        );

        $this->app->bind(
            'App\Repositories\SizeRepositoryInterface',
            'App\Repositories\SizeRepository'
        );
    }
}