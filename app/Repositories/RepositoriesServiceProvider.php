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
            'App\Repositories\VariantRepositoryInterface',
            'App\Repositories\VariantRepository'
        );
    }
}