<?php

namespace App\Library\Ecourier;
use App\Library\Ecourier\AreaApi;
use App\Library\Ecourier\StoreApi;
use App\Library\Ecourier\OrderApi;

class Manage
{
    /**
     * @var AreaApi $area
     */
    private $area;

    /**
     * @var StoreApi $store
     */
    private $store;

    /**
     * @var OrderApi $order
     */
    private $order;

    public function __construct(AreaApi $areaApi, StoreApi $storeApi, OrderApi $orderApi)
    {
        $this->area  = $areaApi;
        $this->store = $storeApi;
        $this->order = $orderApi;
    }

    /**
     * @return AreaApi
     */
    public function area(): AreaApi
    {
        return $this->area;
    }

    /**
     * @return StoreApi
     */
    public function store(): StoreApi
    {
        return $this->store;
    }

    /**
     * @return OrderApi
     */
    public function order(): OrderApi
    {
        return $this->order;
    }
}
