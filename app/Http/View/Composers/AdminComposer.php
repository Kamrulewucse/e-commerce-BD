<?php

namespace App\Http\View\Composers;

use App\Enumeration\OrderStatus;
use App\Models\SaleOrder;
use Illuminate\View\View;

class AdminComposer
{
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $pendingOrders = SaleOrder::where('status', OrderStatus::$PENDING)->count();
        $approvedOrders = SaleOrder::where('status', OrderStatus::$APPROVED)->count();
        $processingOrders = SaleOrder::where('status', OrderStatus::$PROCESSING)->count();
        $onShippingOrders = SaleOrder::where('status', OrderStatus::$ON_SHIPPING)->count();
        $shippedOrders = SaleOrder::where('status', OrderStatus::$SHIPPED)->count();
        $deliveredOrders = SaleOrder::where('status', OrderStatus::$DELIVERED)->count();
        $returnInitiateOrders = SaleOrder::where('status', OrderStatus::$RETURNED_INIT)->count();
        $returnedOrders = SaleOrder::where('status', OrderStatus::$RETURNED)->count();

        $data = [
            'pendingOrders' => $pendingOrders,
            'approvedOrders' => $approvedOrders,
            'processingOrders' => $processingOrders,
            'onShippingOrders' => $onShippingOrders,
            'shippedOrders' => $shippedOrders,
            'deliveredOrders' => $deliveredOrders,
            'returnInitiateOrders' => $returnInitiateOrders,
            'returnedOrders' => $returnedOrders,
        ];

        $view->with('layoutData', $data);
    }
}
