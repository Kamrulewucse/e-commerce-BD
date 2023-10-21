<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Ecourier\AreaApi;
use App\Library\Ecourier\Manage;
use App\Library\Ecourier\OrderApi;
use App\Library\Ecourier\StoreApi;

class EcourierServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->publishes([
//            __DIR__ . "/../config/ecourier.php" => config_path("ecourier.php")
//        ]);
        $this->app->bind("ecourier", function () {
            return new Manage(new AreaApi(), new StoreApi(), new OrderApi());
        });
    }

    /**
     * Register application services
     *
     * @return void
     */
    public function register()
    {
//        $this->mergeConfigFrom(__DIR__ . "/../config/ecourier.php", "ecourier");
//

    }

}
