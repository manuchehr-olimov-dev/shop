<?php

namespace App\Providers;

use App\Http\Kernel;
use Carbon\CarbonInterval;
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
            logger()
                ->channel('telegram')
                ->debug('whenQueryingForLongerThan:' . $connection->query()->toSql());
        });

        $kernel = app(Kernel::class);
        $kernel->whenRequestLifecycleIsLongerThan(
            CarbonInterval::second(5),
            function(){
                logger()
                    ->channel('telegram')
                    ->debug('whenRequestLifecycleIsLongerThan:' . request()->url());
            }

        );
    }
}
