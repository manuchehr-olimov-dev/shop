<?php

namespace App\Providers;

use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
    public function boot()
    {
        Model::preventLazyLoading(!app()->isProduction());
        Model::preventsSilentlyDiscardingAttributes(!app()->isProduction());

        DB::whenqueryingforlongerthan(500,  function(Connection $connection){

        });
    }
}
