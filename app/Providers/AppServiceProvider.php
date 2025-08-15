<?php

namespace App\Providers;

use Carbon\CarbonInterval;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\Kernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private const OPERATION_TIMEOUT = 5;
    /**
     * RegisterRequest any application services.
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
        Model::preventLazyLoading(!app()->isProduction());
        Model::preventSilentlyDiscardingAttributes(!app()->isProduction());

        DB::whenQueryingForLongerThan(
            CarbonInterval::seconds(self::OPERATION_TIMEOUT), 
            function (Connection $connection) {
            logger()
                ->channel('telegram')
                ->debug('query too long ' . $connection->query()->toSql());
        });

        $kernel = app(Kernel::class);
        $kernel->whenRequestLifecycleIsLongerThan(
            CarbonInterval::seconds(self::OPERATION_TIMEOUT), 
            function () {
            logger()
                ->channel('telegram')
                ->debug('request too long ' . request()->url());
        });
    }
}
