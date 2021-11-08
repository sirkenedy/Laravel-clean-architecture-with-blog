<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Post\IPostService;
use App\Services\Post\PostService;

use App\Services\Comment\ICommentService;
use App\Services\Comment\CommentService;

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
        $this->app->bind(ICommentService::class, CommentService::class);
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
