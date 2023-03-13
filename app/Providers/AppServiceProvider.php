<?php

namespace App\Providers;

use App\Services\FoxholeWarApi\FoxholeWarApi;
use App\Services\FoxholeWarApi\FoxholeWarApiInterface;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        App::singleton(FoxholeWarApiInterface::class, function (Application $app) {
            return new FoxholeWarApi();
        });
    }
}
