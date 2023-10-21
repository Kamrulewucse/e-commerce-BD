<?php

namespace App\Providers;

use App\Library\Pathao\AreaApi;
use App\Library\Pathao\Manage;
use App\Library\Pathao\OrderApi;
use App\Library\Pathao\StoreApi;
use Illuminate\Support\ServiceProvider;

class PathaoCourierServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
//        $this->publishes([
//
//            __DIR__ . "/../config/pathao.php" => config_path("pathao.php")
//        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->mergeConfigFrom(__DIR__ . "/config/pathao.php", "pathao");

        $this->app->bind("pathaocourier", function () {
            return new Manage(new AreaApi(), new StoreApi(), new OrderApi());
        });
    }
}
