<?php

namespace App\Http\Controllers\Admin;

use App\Enumeration\OrderStatus;
use App\Http\Controllers\Controller;
use App\Library\Pathao\Facade\PathaoCourier;
use App\Models\Product;
use App\Models\SaleOrder;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {

        $totalSale = SaleOrder::where('status', OrderStatus::$DELIVERED)
            ->sum('total');

        $totalPending = SaleOrder::whereNotIn('status', [OrderStatus::$DELIVERED, OrderStatus::$INIT, OrderStatus::$CANCELLED, OrderStatus::$RETURNED])
            ->sum('total');

        $completedOrder = SaleOrder::where('status', OrderStatus::$DELIVERED)
            ->count();

        $todayOrderAmount = SaleOrder::where('status', '!=', OrderStatus::$INIT)
            ->whereDate('created_at', Carbon::today())
            ->sum('total');

        $latestOrders = SaleOrder::where('status', '!=', OrderStatus::$INIT)
            ->limit(5)
            ->latest()
            ->get();

        $recentlyAddedProducts = Product::limit(3)
            ->where('type',1)
            ->latest()
            ->get();

        // Order Count By Month
        $startDate = [];
        $endDate = [];
        $orderCountLabel = [];
        $orderCount = [];

        for($i=5; $i >= 0; $i--) {
            $date = Carbon::now();
            /*$orderCountLabel[] = date('d M, Y', strtotime("-$i months"));
            $startDate[] = date('Y-m-01', strtotime("-$i month"));
            $endDate[] = date('Y-m-t', strtotime("-$i month"));*/

            $orderCountLabel[] = $date->startOfMonth()->subMonths($i)->format('M, Y');
            $startDate[] = $date->format('Y-m-d');
            $endDate[] = $date->endOfMonth()->format('Y-m-d');
        }

        for($i=0; $i < 6; $i++) {
            $orderCount[] = SaleOrder::whereNotIn('status', [OrderStatus::$INIT, OrderStatus::$RETURNED, OrderStatus::$CANCELLED])
                ->where('created_at', '>=', $startDate[$i])
                ->where('created_at', '<=', $endDate[$i])
                ->count();
        }

        // Product Upload chart
        $uploadCount = [];

        for($i=0; $i < 6; $i++) {
            $uploadCount[] = Product::where('status', 1)
                ->where('created_at', '>=', $startDate[$i])
                ->where('created_at', '<=', $endDate[$i])
                ->count();
        }

        // Best Seller Products
        $bestSellingItemsSql = "SELECT products.id
                FROM products
                LEFT JOIN (SELECT product_id, SUM(quantity) count FROM product_sale_orders GROUP BY product_id) t ON products.id = t.product_id
                WHERE products.status = 1
                 AND count != 0
                ORDER BY count DESC
                LIMIT 8";

        $bestSellingItemsResult = DB::select($bestSellingItemsSql);
        $bestSellingItemsIds = [];

        foreach ($bestSellingItemsResult as $item)
            $bestSellingItemsIds[] = $item->id;

        $bestSellingItemsIdsString = implode(",", $bestSellingItemsIds);
        $bestSellingProductsQuery = Product::query();
        $bestSellingProductsQuery->whereIn('id', $bestSellingItemsIds);

        if (count($bestSellingItemsIds) > 0)
            $bestSellingProductsQuery->orderByRaw('FIELD(id,'.$bestSellingItemsIdsString.')');

        $bestSellingProductsQuery->with('colorImages');
        $bestSellingProducts = $bestSellingProductsQuery->get();

        $saleByAreas = DB::table('sale_orders')
            ->select(DB::raw('count(area_id) as order_count, area_id, areas.bn_name, cities.bn_name as city, areas.lat, areas.long'))
            ->join('areas', 'sale_orders.area_id', '=', 'areas.id')
            ->join('cities', 'sale_orders.city_id', '=', 'cities.id')
            ->whereNoTIn('sale_orders.status', [OrderStatus::$INIT, OrderStatus::$CANCELLED])
            ->groupBy('area_id', 'areas.bn_name', 'cities.bn_name', 'areas.lat', 'areas.long')
            ->get();


        $data = [
            'totalSale' => $totalSale,
            'totalPending' => $totalPending,
            'completedOrder' => $completedOrder,
            'todayOrderAmount' => $todayOrderAmount,
            'latestOrders' => $latestOrders,
            'recentlyAddedProducts' => $recentlyAddedProducts,
            'orderCountLabel' => json_encode($orderCountLabel),
            'orderCount' => json_encode($orderCount),
            'uploadCount' => json_encode($uploadCount),
            'bestSellingProducts' => $bestSellingProducts,
            'salesByAreas' => json_encode($saleByAreas),
        ];

        return view('admin.dashboard', $data);
    }
}
