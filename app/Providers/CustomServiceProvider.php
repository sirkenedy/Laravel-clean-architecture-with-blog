<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Post\IPostService;
use App\Services\Post\PostService;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IPostService::class, PostService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
