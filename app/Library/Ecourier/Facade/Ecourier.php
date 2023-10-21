<?php

namespace App\Library\Ecourier\Facade;
use Illuminate\Support\Facades\Facade;
/**
 * @method static area()
 * @method static store()
 * @method static order()
 * @see Manage
 */
class Ecourier extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ecourier';
    }
}
