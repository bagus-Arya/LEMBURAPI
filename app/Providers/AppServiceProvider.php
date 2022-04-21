<?php

namespace App\Providers;

use App\Contracts\LemburRepositoryInterface;

use App\Repositories\LemburRepository;

use Illuminate\Support\ServiceProvider;
use DB;
use Illuminate\Pagination\Paginator;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LemburRepositoryInterface::class,LemburRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
