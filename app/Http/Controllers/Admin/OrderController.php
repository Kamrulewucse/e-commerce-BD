<?php

namespace App\Http\Controllers\Admin;

use App\Enumeration\OrderStatus;
use App\Http\Controllers\Controller;
use App\Library\Ecourier\Facade\Ecourier;
use App\Library\Pathao\Facade\PathaoCourier;
use App\Models\Area;
use App\Models\City;
use App\Models\Color;
use App\Models\Customer;
use App\Models\DeliveryOption;
use App\Models\Inventory;
use App\Models\InventoryLog;
use App\Models\OrderPackageDetail;
use App\Models\Product;
use App\Models\ProductPackage;
use App\Models\SaleOrder;
use App\Models\Size;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function createOrders()
    {
        $products = Product::where('vendor_id',Auth::guard('vendor')->user()->id)
            ->orderBy('name')
            ->get();
        $packages= ProductPackage::where('vendor_id',Auth::guard('vendor')->user()->id)
            ->orderBy('name')
            ->get();

        foreach ($packages as $package){
             $package->package_id = 'p'.$package->id;
        }
        $cities = City::all();

        return view('vendor.sales_order.create',compact('packages','products','cities'));
    }
    public function createOrdersPost(Request $request)
    {

        $messages = [
            'transaction_id.required_if' => 'The transaction id field is required.',
       ];

        $request->validate([
            'customer_name' => 'required|max:255',
            'mobile' => 'required|min:11|max:11',
            'email' => 'nullable|email|max:50',
            'district' => 'required',
            'area' => 'required',
            'shipping_address' => 'required|max:255',
            'billing_address' => 'nullable|max:255',
            'notes' => 'nullable|max:255',
            'product.*' => 'required',
            'color.*' => 'nullable|integer',
            'size.*' => 'nullable|integer',
            'quantity.*' => 'nullable|numeric',
            'unit_price.*' => 'required|numeric|min:0',
            'payment_type' => 'required',
            'transaction_id' => 'required_if:payment_type,==,2,3,4',
            'vat' => 'nullable|numeric',
            'discount' => 'required|numeric|min:0',
            'paid' => 'required|numeric|min:0',
        ],$messages);

        $customer = new Customer();
        $customer->name = $request->customer_name;
        $customer->mobile = $request->mobile;
        $customer->shipping_address = $request->shipping_address;
        $customer->billing_address = $request->billing_address;
        $customer->email = $request->email;
        $customer->save();

        $order = new SaleOrder();
        $order->order_no = rand(10000000, 99999999);
        $order->vendor_id = Auth::guard('vendor')->user()->id;
        $order->customer_id = $customer->id;
        $order->city_id = $request->district;
        $order->area_id = $request->area;
        $order->payment_method = $request->payment_type;
        $order->transaction_id = $request->payment_type != 1 ? $request->transaction_id : null;
        $order->notes = $request->notes;
        $order->status = OrderStatus::$APPROVED;
        $order->approved_at = Carbon::now();
        $order->save();

        $subTotal = 0;

        $counter = 0;
        foreach ($request->product as $reqProduct) {

            $string = $reqProduct;
            if ($string[0] != 'p') {
                $product = Product::find($reqProduct);
            }else {
                $packageId = substr($reqProduct, 1);
                $product = ProductPackage::find($packageId);
                $reqProduct = $packageId;

            }


            $color = Color::where('id',$request->color[$counter])->first();
            $size = Size::where('id',$request->size[$counter])->first();

            $order->products()->attach($reqProduct, [
                'product_type' => $string[0] != 'p' ? 1 : 2,
                'name' => $product->name,
                'color' => $color ? $color->name : NULL,
                'color_id' => $request->color[$counter],
                'size' => $size ? $size->name : NULL,
                'size_id' => $request->size[$counter],
                'quantity' => $request->quantity[$counter],
                'unit_price' => $request->unit_price[$counter],
                'total' => $request->quantity[$counter] ? $request->quantity[$counter] * $request->unit_price[$counter] : $request->unit_price[$counter],

            ]);

            foreach($order->products as $singleProduct) {
                if ($singleProduct->pivot->product_type == 2) {
                    $package = ProductPackage::find($reqProduct);
                    foreach ($package->items as $item) {
                        $packageDetail = new OrderPackageDetail();
                        $packageDetail->product_sale_order_id = $singleProduct->pivot->id;
                        $packageDetail->product_package_id = $package->id;
                        $packageDetail->product_id = $item->product_id;
                        $packageDetail->name = $item->product->name;
                        $packageDetail->color_id = $item->color_id;
                        $packageDetail->color = $item->color_id ? $item->color->name : Null;
                        $packageDetail->size_id = $item->size_id;
                        $packageDetail->size = $item->size_id ? $item->size->name : Null;
                        $packageDetail->quantity = $item->quantity;
                        $packageDetail->unit_price = $item->unit_price;
                        $packageDetail->total = $item->quantity ? $item->quantity * $item->unit_price : $item->unit_price;
                        $packageDetail->save();
                    }
                }

            }

            $subTotal += $request->quantity[$counter] ? $request->quantity[$counter] * $request->unit_price[$counter] : $request->unit_price[$counter];
            $counter++;
        }


        $order->subtotal = $subTotal;
        $order->shipping_cost = $request->shipping_cost;
        $vat = ($subTotal * $request->vat ?? 0) / 100;
        $order->tax_percengate = $request->vat ?? 0;
        $order->tax = $vat;
        $total = $subTotal + $request->shipping_cost + $vat  - $request->discount;
        $order->total = $total;
        $order->discount = $request->discount;
        $order->paid = $request->paid;
        $due = $total - $request->paid;
        $order->due = $due;
        $order->save();


        return redirect()->route('admin.order.view',['order'=>$order->id]);

    }

    public function editOrders(SaleOrder $order)
    {
        $products = Product::where('vendor_id',Auth::guard('vendor')->user()->id)
            ->orderBy('name')
            ->get();
        $packages= ProductPackage::where('vendor_id',Auth::guard('vendor')->user()->id)
            ->orderBy('name')
            ->get();

        foreach ($packages as $package){
             $package->package_id = 'p'.$package->id;
        }
        $cities = City::all();

        $order->load('customer','city','area');

        foreach ($order->products as $item){
            if ($item->pivot->product_type == 2) {
                $item->custom_product_id = 'p'.$item->pivot->product_id;
            }else{
                $item->custom_product_id = $item->pivot->product_id;
            }

        }


        return view('admin.order.edit',compact('order','packages','products','cities'));
    }

    public function editOrdersPost(SaleOrder $order,Request $request)
    {
        $messages = [
            'transaction_id.required_if' => 'The transaction id field is required.',
        ];


        $request->validate([
            'customer_name' => 'required|max:255',
            'mobile' => 'required|min:11|max:11',
            'email' => 'nullable|email|max:50',
            'district' => 'required',
            'area' => 'required',
            'shipping_address' => 'required|max:255',
            'billing_address' => 'nullable|max:255',
            'notes' => 'nullable|max:255',
            'product.*' => 'required',
            'color.*' => 'nullable|integer',
            'size.*' => 'nullable|integer',
            'quantity.*' => 'nullable|numeric',
            'unit_price.*' => 'required|numeric|min:0',
            'payment_type' => 'required',
            'transaction_id' => 'required_if:payment_type,==,2,3,4',
            'vat' => 'nullable|numeric',
            'discount' => 'required|numeric|min:0',
            'paid' => 'required|numeric|min:0',
        ],$messages);

        $customer = Customer::find($order->customer->id);
        $customer->name = $request->customer_name;
        $customer->mobile = $request->mobile;
        $customer->shipping_address = $request->shipping_address;
        $customer->billing_address = $request->billing_address;
        $customer->email = $request->email;
        $customer->save();

        $order->city_id = $request->district;
        $order->area_id = $request->area;
        $order->payment_method = $request->payment_type;
        $order->transaction_id = $request->payment_type != 1 ? $request->transaction_id : null;
        $order->notes = $request->notes;
        $order->save();


        $subTotal = 0;
        $counter = 0;

        $purchaseId = DB::table('product_sale_order')
                    ->where('sale_order_id',$order->id)
                    ->pluck('id')->toArray();


        OrderPackageDetail::whereIn('product_sale_order_id',$purchaseId)->delete();
        DB::table('product_sale_order')
                ->where('sale_order_id',$order->id)->delete();

        foreach ($request->product as $reqProduct) {

            $string = $reqProduct;
            if ($string[0] != 'p') {
                $product = Product::find($reqProduct);
            }else {
                $packageId = substr($reqProduct, 1);
                $product = ProductPackage::find($packageId);
                $reqProduct = $packageId;

            }

            $color = Color::where('id',$request->color[$counter])->first();
            $size = Size::where('id',$request->size[$counter])->first();

            $order->products()->attach($reqProduct, [
                'product_type' => $string[0] != 'p' ? 1 : 2,
                'name' => $product->name,
                'color' => $color ? $color->name : NULL,
                'color_id' => $request->color[$counter],
                'size' => $size ? $size->name : NULL,
                'size_id' => $request->size[$counter],
                'quantity' => $request->quantity[$counter],
                'unit_price' => $request->unit_price[$counter],
                'total' => $request->quantity[$counter] ? $request->quantity[$counter] * $request->unit_price[$counter] : $request->unit_price[$counter],

            ]);

            foreach($order->products as $singleProduct) {
                if ($singleProduct->pivot->product_type == 2) {
                    $package = ProductPackage::find($reqProduct);

                    foreach ($package->items as $item) {
                        $packageDetail = new OrderPackageDetail();
                        $packageDetail->product_sale_order_id = $singleProduct->pivot->id;
                        $packageDetail->product_package_id = $package->id;
                        $packageDetail->product_id = $item->product_id;
                        $packageDetail->name = $item->product->name;
                        $packageDetail->color_id = $item->color_id;
                        $packageDetail->color = $item->color_id ? $item->color->name : Null;
                        $packageDetail->size_id = $item->size_id;
                        $packageDetail->size = $item->size_id ? $item->size->name : Null;
                        $packageDetail->quantity = $item->quantity;
                        $packageDetail->unit_price = $item->unit_price;
                        $packageDetail->total = $item->quantity ? $item->quantity * $item->unit_price : $item->unit_price;
                        $packageDetail->save();
                    }
                }
            }

            $subTotal += $request->quantity[$counter] ? $request->quantity[$counter] * $request->unit_price[$counter] : $request->unit_price[$counter];
            $counter++;
        }

        $order->subtotal = $subTotal;
        $order->shipping_cost = $request->shipping_cost;
        $vat = ($subTotal * $request->vat) / 100;
        $order->tax_percengate = $request->vat;
        $order->tax = $vat;
        $total = $subTotal + $request->shipping_cost + $vat  - $request->discount;
        $order->total = $total;
        $order->discount = $request->discount;
        $order->paid = $request->paid;
        $due = $total - $request->paid;
        $order->due = $due;
        $order->save();


        return redirect()->route('admin.order.view',['order'=>$order->id]);


    }
    public function getArea(Request $request) {
        $areas = Area::where('city_id', $request->cityId)->get();

        return response()->json($areas->toArray());
    }


    public function pendingDatatable()
    {

        $query = SaleOrder::with('customer')
                    ->where('status',OrderStatus::$PENDING);

        return DataTables::eloquent($query)

            ->editColumn('created_at', function(SaleOrder $order) {
                return date("j F, Y h:i A", strtotime($order->created_at));
            })
            ->editColumn('total', function(SaleOrder $order) {
                return '৳ '.number_format($order->total,2);
            })
            ->addColumn('action', function(SaleOrder $order) {
                return '<div class="btn-group">

                                     <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a role="button" class="dropdown-item btn-approved" data-id="'.$order->id.'">Approved</a></li>
                                            <li><a role="button" class="dropdown-item btn-cancel" data-id="'.$order->id.'">Cancel</a></li>
                                            <li><a class="dropdown-item" href="'.route('order.view', ['order' => $order->id]).'">View</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="'.route('order.customer_copy', ['order' => $order->id]).'">Print</a></li>
                                        </ul>
                                    </div>';
            })
            ->addColumn('customer_info', function(SaleOrder $order) {
                return $order->customer->name.'<br>'. $order->customer->mobile_no.'<br>'.$order->shipping_address.', '.$order->area->name.', '.$order->city->name;
            })
            ->addColumn('product_info', function(SaleOrder $order) {
                $numItems = count($order->products);
                $i = 0;
                $products = '<ul class="table-attribute">';
                $products .= '';
                foreach($order->products as $key => $item){
                    $products .='<li>';
                    $add = ++$i == $numItems ? '' : ',';
                    $products .= $item->product_name.(!$item->quantity  ? '' : '<span class="qty-class">(Color: '.$item->color.', Size: '.$item->size.',Qty: '.(int)$item->quantity.')</span>').$add.'<br>';
                    $products .='</li>';
                }
                $products .= '</ul>';
                return $products;
            })
            ->rawColumns(['action','customer_info','product_info'])
            ->toJson();
    }

    public function approvedDatatable()
    {

        $query = SaleOrder::with('customer')
                    ->where('status',OrderStatus::$APPROVED);

        return DataTables::eloquent($query)

            ->editColumn('approved_at', function(SaleOrder $order) {
                return date("j F, Y h:i A", strtotime($order->approved_at));
            })
            ->editColumn('total', function(SaleOrder $order) {
                return '৳ '.number_format($order->total,2);
            })
            ->addColumn('action', function(SaleOrder $order) {
                return '<div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" role="button" class="dropdown-item btn-process" data-id="'.$order->id.'">Processing</a></li>
                                            <li><a role="button" class="dropdown-item btn-cancel" data-id="'.$order->id.'">Cancel</a></li>
                                            <li><a class="dropdown-item" href="'.route('order.view', ['order' => $order->id]).'">View</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="'.route('order.customer_copy', ['order' => $order->id]).'">Print</a></li>
                                        </ul>
                                    </div>';
            })
            ->addColumn('customer_info', function(SaleOrder $order) {
                return $order->customer->name.'<br>'. $order->customer->mobile_no.'<br>'.$order->shipping_address.', '.$order->area->name.', '.$order->city->name;
            })
            ->addColumn('product_info', function(SaleOrder $order) {
                $numItems = count($order->products);
                $i = 0;
                $products = '<ul class="table-attribute">';
                $products .= '';
                foreach($order->products as $key => $item){
                    $products .='<li>';
                    $add = ++$i == $numItems ? '' : ',';
                    $products .= $item->product_name.(!$item->quantity  ? '' : '<span class="qty-class">(Color: '.$item->color.', Size: '.$item->size.',Qty: '.(int)$item->quantity.')</span>').$add.'<br>';
                    $products .='</li>';
                }
                $products .= '</ul>';
                return $products;
            })
            ->rawColumns(['action','customer_info','product_info'])
            ->toJson();
    }
    public function processingDatatable()
    {
        $query = SaleOrder::with('customer')
            ->where('status',OrderStatus::$PROCESSING);

        return DataTables::eloquent($query)

            ->editColumn('processed_at', function(SaleOrder $order) {
                return date("j F, Y h:i A", strtotime($order->processed_at));
            })
            ->editColumn('total', function(SaleOrder $order) {
                return '৳ '.number_format($order->total,2);
            })
            ->addColumn('action', function(SaleOrder $order) {
                if($order->delivery_option_id == 1 ||
                    $order->delivery_option_id == 2 ||
                    $order->delivery_option_id == 3){

                    return '<div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </button>
                                <ul class="dropdown-menu">
                                <li><a href="#" role="button" class="dropdown-item btn-pathao" data-id="'.$order->id.'">Order Pathao Delivery</a></li>
                                <li><a href="#" role="button" class="dropdown-item btn-shipped" data-id="'.$order->id.'">Shipped</a></li>
                                <li><a role="button" class="dropdown-item btn-cancel" data-id="'.$order->id.'">Cancel</a></li>
                                <li><a class="dropdown-item" href="'.route('order.view', ['order' => $order->id]).'">View</a></li>
                                <li><a class="dropdown-item" target="_blank" href="'.route('order.customer_copy', ['order' => $order->id]).'">Print</a></li>
                                </ul>
                            </div>';

                }elseif($order->delivery_option_id == 4 ||
                    $order->delivery_option_id == 5 ||
                    $order->delivery_option_id == 6){

                    return '<div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </button>
                                <ul class="dropdown-menu">
                                <li><a href="#" role="button" class="dropdown-item btn-ecourier" data-id="'.$order->id.'">Order E-Courier Delivery</a></li>
                                <li><a href="#" role="button" class="dropdown-item btn-shipped" data-id="'.$order->id.'">Shipped</a></li>
                                <li><a role="button" class="dropdown-item btn-cancel" data-id="'.$order->id.'">Cancel</a></li>
                                <li><a class="dropdown-item" href="'.route('order.view', ['order' => $order->id]).'">View</a></li>
                                <li><a class="dropdown-item" target="_blank" href="'.route('order.customer_copy', ['order' => $order->id]).'">Print</a></li>
                                </ul>
                            </div>';

                }
            })
            ->addColumn('customer_info', function(SaleOrder $order) {
                return ($order->customer->name ?? '').'<br>'.( $order->mobile_no ?? '').'<br>'.$order->shipping_address.', '.($order->country->name ?? '').', '.$order->city;
            })
            ->addColumn('product_info', function(SaleOrder $order) {
                $numItems = count($order->products);
                $i = 0;
                $products = '<ul class="table-attribute">';
                $products .= '';
                foreach($order->products as $key => $item){
                    $products .='<li>';
                    $add = ++$i == $numItems ? '' : ',';
                    $products .= $item->product_name.(!$item->quantity  ? '' : '<span class="qty-class">(Color: '.$item->color.', Size: '.$item->size.',Qty: '.(int)$item->quantity.')</span>').$add.'<br>';
                    $products .='</li>';
                }
                $products .= '</ul>';
                return $products;
            })
            ->rawColumns(['action','customer_info','product_info'])
            ->toJson();
    }
    public function onShippingDatatable()
    {

        $query = SaleOrder::with('customer')
                    ->where('status',OrderStatus::$ON_SHIPPING);

        return DataTables::eloquent($query)

            ->editColumn('on_shipping_at', function(SaleOrder $order) {
                return date("j F, Y h:i A", strtotime($order->on_shipping_at));
            })

            ->editColumn('total', function(SaleOrder $order) {
                return '৳ '.number_format($order->total,2);
            })
            ->addColumn('action', function(SaleOrder $order) {
                return '<div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                             <li><a role="button" class="dropdown-item btn-shipped" data-id="'.$order->id.'">Shipped</a></li>
                                            <li><a role="button" class="dropdown-item btn-cancel" data-id="'.$order->id.'">Cancel</a></li>
                                            <li><a class="dropdown-item" href="'.route('order.view', ['order' => $order->id]).'">View</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="'.route('order.customer_copy', ['order' => $order->id]).'">Print</a></li>
                                        </ul>
                                    </div>';
            })
            ->addColumn('customer_info', function(SaleOrder $order) {
                return $order->customer->name.'<br>'. $order->customer->mobile_no.'<br>'.$order->shipping_address.', '.$order->area->name.', '.$order->city->name;
            })
            ->addColumn('product_info', function(SaleOrder $order) {
                $numItems = count($order->products);
                $i = 0;
                $products = '<ul class="table-attribute">';
                $products .= '';
                foreach($order->products as $key => $item){
                    $products .='<li>';
                    $add = ++$i == $numItems ? '' : ',';
                    $products .= $item->product_name.(!$item->quantity  ? '' : '<span class="qty-class">(Color: '.$item->color.', Size: '.$item->size.',Qty: '.(int)$item->quantity.')</span>').$add.'<br>';
                    $products .='</li>';
                }
                $products .= '</ul>';
                return $products;
            })
            ->rawColumns(['action','customer_info','product_info'])
            ->toJson();
    }
    public function shippedDatatable()
    {
        $query = SaleOrder::with('customer')
                    ->where('status',OrderStatus::$SHIPPED);

        return DataTables::eloquent($query)


            ->editColumn('shipped_at', function(SaleOrder $order) {
                return date("j F, Y h:i A", strtotime($order->shipped_at));
            })
            ->editColumn('total', function(SaleOrder $order) {
                return '৳ '.number_format($order->total,2);
            })
            ->addColumn('action', function(SaleOrder $order) {
                return '<div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                           <li><a role="button" class="dropdown-item btn-complete" data-id="'.$order->id.'">Delivered</a></li>
                                            <li><a role="button" class="dropdown-item btn-cancel" data-id="'.$order->id.'">Cancel</a></li>
                                            <li><a class="dropdown-item" href="'.route('order.view', ['order' => $order->id]).'">View</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="'.route('order.customer_copy', ['order' => $order->id]).'">Print</a></li>
                                        </ul>
                                    </div>';
            })
            ->addColumn('customer_info', function(SaleOrder $order) {
                return ($order->customer->name ?? '').'<br>'.( $order->mobile_no ?? '').'<br>'.$order->shipping_address.', '.($order->country->name ?? '').', '.$order->city;
            })
            ->addColumn('product_info', function(SaleOrder $order) {
                $numItems = count($order->products);
                $i = 0;
                $products = '<ul class="table-attribute">';
                $products .= '';
                foreach($order->products as $key => $item){
                    $products .='<li>';
                    $add = ++$i == $numItems ? '' : ',';
                    $products .= $item->product_name.(!$item->quantity  ? '' : '<span class="qty-class">(Color: '.$item->color.', Size: '.$item->size.',Qty: '.(int)$item->quantity.')</span>').$add.'<br>';
                    $products .='</li>';
                }
                $products .= '</ul>';
                return $products;
            })
            ->rawColumns(['action','customer_info','product_info'])
            ->toJson();
    }
    public function returnInitiateDatatableDatatable()
    {
        $query = SaleOrder::with('customer')
                    ->where('status',OrderStatus::$RETURNED_INIT);

        return DataTables::eloquent($query)


            ->editColumn('return_init_at', function(SaleOrder $order) {
                return date("j F, Y h:i A", strtotime($order->return_init_at));
            })
            ->editColumn('total', function(SaleOrder $order) {
                return '৳ '.number_format($order->total,2);
            })
            ->addColumn('action', function(SaleOrder $order) {
                return '<div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                           <li><a role="button" class="dropdown-item btn-return" data-id="'.$order->id.'">Returned</a></li>
                                            <li><a role="button" class="dropdown-item btn-cancel" data-id="'.$order->id.'">Cancel</a></li>
                                            <li><a class="dropdown-item" href="'.route('order.view', ['order' => $order->id]).'">View</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="'.route('order.customer_copy', ['order' => $order->id]).'">Print</a></li>
                                        </ul>
                                    </div>';
            })
            ->addColumn('customer_info', function(SaleOrder $order) {
                return $order->customer->name.'<br>'. $order->customer->mobile_no.'<br>'.$order->shipping_address.', '.$order->area->name.', '.$order->city->name;
            })
            ->addColumn('product_info', function(SaleOrder $order) {
                $numItems = count($order->products);
                $i = 0;
                $products = '<ul class="table-attribute">';
                $products .= '';
                foreach($order->products as $key => $item){
                    $products .='<li>';
                    $add = ++$i == $numItems ? '' : ',';
                    $products .= $item->product_name.(!$item->quantity  ? '' : '<span class="qty-class">(Color: '.$item->color.', Size: '.$item->size.',Qty: '.(int)$item->quantity.')</span>').$add.'<br>';
                    $products .='</li>';
                }
                $products .= '</ul>';
                return $products;
            })
            ->rawColumns(['action','customer_info','product_info'])
            ->toJson();
    }
    public function completeDatatable()
    {

        $query = SaleOrder::with('customer')
                  ->where('status',OrderStatus::$DELIVERED);

        return DataTables::eloquent($query)

            ->editColumn('delivered_at', function(SaleOrder $order) {
                return date("j F, Y h:i A", strtotime($order->delivered_at));
            })
            ->editColumn('total', function(SaleOrder $order) {
                return '৳ '.number_format($order->total,2);
            })
            ->addColumn('action', function(SaleOrder $order) {
                return '<div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                           <li><a role="button" class="dropdown-item btn-return" data-id="'.$order->id.'">Returned</a></li>

                                            <li><a class="dropdown-item" href="'.route('order.view', ['order' => $order->id]).'">View</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="'.route('order.customer_copy', ['order' => $order->id]).'">Print</a></li>
                                        </ul>
                                    </div>';
            })
            ->addColumn('customer_info', function(SaleOrder $order) {
                return ($order->customer->name ?? '').'<br>'.( $order->mobile_no ?? '').'<br>'.$order->shipping_address.', '.($order->country->name ?? '').', '.$order->city;
            })
            ->addColumn('product_info', function(SaleOrder $order) {
                $numItems = count($order->products);
                $i = 0;
                $products = '<ul class="table-attribute">';
                $products .= '';
                foreach($order->products as $key => $item){
                    $products .='<li>';
                    $add = ++$i == $numItems ? '' : ',';
                    $products .= $item->product_name.(!$item->quantity  ? '' : '<span class="qty-class">(Color: '.$item->color.', Size: '.$item->size.',Qty: '.(int)$item->quantity.')</span>').$add.'<br>';
                    $products .='</li>';
                }
                $products .= '</ul>';
                return $products;
            })
            ->rawColumns(['action','customer_info','product_info'])
            ->toJson();
    }
    public function returnedDatatable()
    {

        $query = SaleOrder::with('customer')
                  ->where('status',OrderStatus::$RETURNED);

        return DataTables::eloquent($query)

            ->editColumn('return_at', function(SaleOrder $order) {
                return date("j F, Y h:i A", strtotime($order->return_at));
            })
            ->editColumn('total', function(SaleOrder $order) {
                return '৳ '.number_format($order->total,2);
            })
            ->addColumn('action', function(SaleOrder $order) {
                return '<div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="'.route('order.view', ['order' => $order->id]).'">View</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="'.route('order.customer_copy', ['order' => $order->id]).'">Print</a></li>
                                        </ul>
                                    </div>';
            })
            ->addColumn('customer_info', function(SaleOrder $order) {
                return ($order->customer->name ?? '').'<br>'.( $order->mobile_no ?? '').'<br>'.$order->shipping_address.', '.($order->country->name ?? '').', '.$order->city;
            })
            ->addColumn('product_info', function(SaleOrder $order) {
                $numItems = count($order->products);
                $i = 0;
                $products = '<ul class="table-attribute">';
                $products .= '';
                foreach($order->products as $key => $item){
                    $products .='<li>';
                    $add = ++$i == $numItems ? '' : ',';
                    $products .= $item->product_name.(!$item->quantity  ? '' : '<span class="qty-class">(Color: '.$item->color.', Size: '.$item->size.',Qty: '.(int)$item->quantity.')</span>').$add.'<br>';
                    $products .='</li>';
                }
                $products .= '</ul>';
                return $products;
            })
            ->rawColumns(['action','customer_info','product_info'])
            ->toJson();
    }


    public function pendingOrders() {
        $total= SaleOrder::where('status', OrderStatus::$PENDING)
            ->sum('total');

        return view('admin.order.pending', compact('total'));
    }
    public function approvedOrders() {
        $total= SaleOrder::where('status', OrderStatus::$APPROVED)
            ->sum('total');

        return view('admin.order.approved', compact('total'));
    }
    public function processingOrders() {
//        $baseUrl = 'https://api-hermes.pathao.com/aladdin/api/v1';
//        //$baseUrl = 'https://hermes-api.p-stageenv.xyz/aladdin/api/v1';
//        $client = new Client();
//        $getAccessToken = $client->request('POST', $baseUrl.'/issue-token', [
//            'form_params' => [
//                'client_id' => 1230,
//                'client_secret' => 'llshxjHnJaIy6my905HuW6v1KvaVhoazfjuk1y7K',
//                'username' => 'bangladeshdrip@gmail.com',
//                'password' => '123456',
////                'client_id' => 267,
////                'client_secret' => 'wRcaibZkUdSNz2EI9ZyuXLlNrnAv0TdPUPXMnD39',
////                'username' => 'test@pathao.com',
////                'password' => 'lovePathao',
//                'grant_type' => 'password',
//            ]
//        ]);
//        if ($getAccessToken->getStatusCode() == 200){
//            $accessTokenData =  json_decode($getAccessToken->getBody()->getContents());
//
//            $getStores = $client->get($baseUrl.'/stores',[
//                'headers' => [
//                    'Accept' => 'application/json',
//                    'Authorization' => 'Bearer '.$accessTokenData->access_token,
//                ],
//            ]);
//            $getCities = $client->get($baseUrl.'/countries/1/city-list',[
//                'headers' => [
//                    'Accept' => 'application/json',
//                    'Authorization' => 'Bearer '.$accessTokenData->access_token,
//                ],
//            ]);
//            $getZones = $client->get($baseUrl.'/cities/52/zone-list',[
//                'headers' => [
//                    'Accept' => 'application/json',
//                    'Authorization' => 'Bearer '.$accessTokenData->access_token,
//                ],
//            ]);
//            $getAreas = $client->get($baseUrl.'/zones/156/area-list',[
//                'headers' => [
//                    'Accept' => 'application/json',
//                    'Authorization' => 'Bearer '.$accessTokenData->access_token,
//                ],
//            ]);
//            $stores = json_decode($getStores->getBody()->getContents());
//            $cities = json_decode($getCities->getBody()->getContents());
//            $zones = json_decode($getZones->getBody()->getContents());
//            $areas = json_decode($getAreas->getBody()->getContents());
//           // dd($stores,$cities,$zones,$areas);
//
//                $createOrders = $client->request('POST',$baseUrl.'/orders',[
//                    'headers' => [
//                        'Accept' => 'application/json',
////                        'Content-Type'=>'application/json',
//                        'Authorization' => 'Bearer '.$accessTokenData->access_token,
//                    ],
//                    'form_params'=>[
//                        "store_id"=>"52818",
//                        "merchant_order_id"=>Str::uuid()->toString(),
//                        "recipient_name"=>"Ashik Khan",
//                        "recipient_phone"=>"01726979426",
//                        "recipient_address"=>"Mohanagor Project Rampura, Dhaka",
//                        "recipient_city"=>"52",
//                        "recipient_zone"=>"156",
//                        "recipient_area"=>"13193",
//                        "delivery_type"=>"48",
//                        "item_type"=>"2",
//                        "special_instruction"=>"",
//                        "item_quantity"=>"2",
//                        "item_weight"=>"2",
//                        "amount_to_collect"=>"0",
//                        "item_description"=>"Total Bill Amount 3000",
//
//                    ],
//                ]);
//                if ($createOrders->getStatusCode() == 200){
//                    dd(json_decode($getStores->getBody()->getContents()));
//                }
//            }


        $total= SaleOrder::where('status', OrderStatus::$PROCESSING)
            ->sum('total');

        return view('admin.order.processing', compact('total'));
    }

    public function pathaoDeliveryOrderRequest(Request $request)
    {
        //dd($request->all());
        $rules = [
            'store' => 'required',
            'city' => 'required',
            'zone' => 'required',
            'area' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $order = SaleOrder::where('id',$request->order_id)->first();
        $delivery_type = '';

        if ($order->delivery_option_id == 1||$order->delivery_option_id == 3){
            $delivery_type = 48;
        }elseif ($order->delivery_option_id == 2){
            $delivery_type = 12;
        }
        //dd($order->totalWeight());

        //order_id
        PathaoCourier::order()
            ->create([
                "store_id"            => $request->store, // Find in store list,
                "merchant_order_id"   => Str::uuid()->toString(), // Unique order id
                "recipient_name"      => $order->address->title.' '.$order->address->first_name.' '.$order->address->last_name, // Customer name
                "recipient_phone"     => $order->address->mobile_no_1, // Customer phone
                "recipient_address"   => $order->address->delivery_address.' '.$order->address->apartment_details, // Customer address
                "recipient_city"      => $request->city, // Find in city method
                "recipient_zone"      => $request->zone, // Find in zone method
                "recipient_area"      => $request->area, // Find in Area method
                "delivery_type"       => $delivery_type, // 48 for normal delivery or 12 for on demand delivery
                "item_type"           => "2", // 1 for document,2 for parcel
                "special_instruction" => "",
                "item_quantity"       => $order->totalQuantity(), // item quantity
                "item_weight"         => $order->totalWeight(), // parcel weight
                "amount_to_collect"   => 0, // amount to collect
                "item_description"    => $order->ProductNames // product details
              ]);

        return response()->json(['success' => true, 'message' => 'Pathao Order Delivery  Request Created.']);

    }
    public function ecourierDeliveryOrderRequest(Request $request)
    {
        $rules = [
            'city' => 'required',
            'thana' => 'required',
            'postcode' => 'required',
            'area' => 'required',
            //'package' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $order = SaleOrder::where('id',$request->order_id)->first();

        $package_code = '';

        if ($order->delivery_option_id == 4){
            $package_code = "#4023";
        }elseif ($order->delivery_option_id == 6){
            $package_code = "#3755";
        }

        $orderCreated = Ecourier::order()->create([
            "recipient_name"       => $order->address->title.' '.$order->address->first_name.' '.$order->address->last_name, // Parcel receiver’s name
            "recipient_mobile"     => $order->address->mobile_no_1, // Parcel receiver’s mobile number
            "recipient_city"       => $request->city, // Parcel receiver’s city name
            "recipient_thana"      => $request->thana, // Parcel receiver’s thana name
            "recipient_area"       => $request->area, // Parcel receiver’s area name
            "package_code"         => $package_code, // Package code find in package API
            "recipient_address"    => $order->address->delivery_address.' '.$order->address->apartment_details, // Parcel receiver’s full address
            "product_price"        => "0", // Receive amount from parcel receiver’s
            "payment_method"       => "CCRD", // Cash On Delivery – COD,Point of Sale – POS, Mobile Payment – MPAY, Card Payment – CCRD
            "recipient_zip"        => $request->postcode, // Parcel receiver’s ZIP Code
            "parcel_type"          => "BOX", // For box -> BOX For Documents -> DOC
            "requested_delivery_time"      => date('YYYY-MM-DD'), //(Optional) For box -> BOX For Documents -> DOC
            "product_id"           => "", //(Optional)
            "pick_address"           => "", //(Optional)
            "pick_hub"           => "", //(Optional)
            "parcel_detail"        => $order->ProductNames, // Parcel product or documents details
            "number_of_item"       => $order->totalQuantity(), // Total quantity
            "ep_id"                => Str::uuid()->toString(), // Invoice Id
            "actual_product_price" => "0", // Parcel product actual price
            "special_instruction" => "Call Me", //(Optional) About product
            "comments" => "This Test Order", //(optional) Instructions for  delivery. not than 255 characters
        ]);
        //dd($orderCreated);
        return response()->json(['success' => true, 'message' => 'E-Courier Order Delivery  Request Created.']);

    }

    public function onShippingOrders() {
        $total = SaleOrder::where('status', OrderStatus::$ON_SHIPPING)
            ->sum('total');

        return view('admin.order.on_shipping', compact('total'));
    }

    public function shippedOrders() {
        $total = SaleOrder::where('status', OrderStatus::$SHIPPED)
            ->sum('total');

        return view('admin.order.shipped', compact('total'));
    }

    public function deliveredOrders() {
        $total = SaleOrder::where('status', OrderStatus::$DELIVERED)
            ->sum('total');
        return view('admin.order.completed', compact('total'));
    }
    public function returnInitiateOrders() {
        $total = SaleOrder::where('status', OrderStatus::$RETURNED_INIT)
            ->sum('total');
        return view('admin.order.return_initiate', compact('total'));
    }
    public function returnedOrders() {
        $total = SaleOrder::where('status', OrderStatus::$RETURNED)
            ->sum('total');

        //dd(SaleOrder::first());

        return view('admin.order.returned', compact('total'));
    }

    public function viewOrder(SaleOrder $order) {
        return view('admin.order.details', compact('order'));
    }

    public function customerCopy(SaleOrder $order) {
        return view('admin.order.customer_copy', compact('order'));
    }

    public function approvedOrder(Request $request) {


        SaleOrder::where('id', $request->orderId)
            ->where('status', OrderStatus::$PENDING)
            ->update([
                'status' => OrderStatus::$APPROVED,
                'approved_at' => Carbon::now(),
            ]);
        $order = SaleOrder::where('id', $request->orderId)->first();

        return response()->json(['success' => true, 'message' => 'Order Approved.', 'redirect_url' => route('order.view',['order'=>$order->id])]);

    }
    public function processingOrder(Request $request) {

        SaleOrder::where('id', $request->orderId)
            ->where('status', OrderStatus::$APPROVED)
            ->update([
                'status' => OrderStatus::$PROCESSING,
                'processed_at' => Carbon::now(),
            ]);
        return response()->json(['success' => true, 'message' => 'Order Processing.', 'redirect_url' => route('order.processing')]);

    }

    public function shipOrder(Request $request) {
        SaleOrder::where('id', $request->orderId)
            ->where('status', OrderStatus::$PROCESSING)
            ->update([
                'status' => OrderStatus::$ON_SHIPPING,
                'on_shipping_at' => Carbon::now(),
            ]);
        return response()->json(['success' => true, 'message' => 'Order On-shipping.', 'redirect_url' => route('order.on_shipping')]);
    }

    public function shippedOrder(Request $request) {


        $order = SaleOrder::where('id', $request->orderId)
            ->where('status', OrderStatus::$PROCESSING)
            ->first();

        foreach ($order->products  as $key => $product){

           $inventory = Inventory::where('product_id',$product->product_id)
                        ->where('color_id',$product->color_id)
                        ->where('size_id',$product->size_id)
                        ->first();

           if ($inventory){
               if ($inventory->quantity < $product->quantity){
                   $message = $product->product_name.' Color: '.$product->color.' Size: '.$product->size.' is insufficient Quantity';
                   return response()->json(['success' => false, 'message' => $message, 'redirect_url' => route('order.shipped')]);

               }
           }else{
               $message = $product->product_name.' Color: '.$product->color.' Size: '.$product->size.' is insufficient Quantity';
               return response()->json(['success' => false, 'message' => $message, 'redirect_url' => route('order.shipped')]);

           }


        }

        foreach ($order->products  as $key => $product){

            $inventory = Inventory::where('product_id',$product->product_id)
                ->where('color_id',$product->color_id)
                ->where('size_id',$product->size_id)
                ->first();

            $inventory->decrement('quantity',$product->quantity);
        }

        SaleOrder::where('id', $request->orderId)
            ->where('status', OrderStatus::$PROCESSING)
            ->update([
                'status' => OrderStatus::$SHIPPED,
                'shipped_at' => Carbon::now(),
            ]);


        return response()->json(['success' => true, 'message' => 'Order Shipped.', 'redirect_url' => route('order.shipped')]);

    }

    public function deliveryOrder(Request $request) {
        $order = SaleOrder::find($request->orderId);
        SaleOrder::where('id', $request->orderId)
            ->where('status', OrderStatus::$SHIPPED)
            ->update([
                'due' => 0,
                'paid' => $order->due,
                'status' => OrderStatus::$DELIVERED,
                'delivered_at' => Carbon::now(),
            ]);

        return response()->json(['success' => true, 'message' => 'Order Completed.', 'redirect_url' => route('order.view',['order'=>$order->id])]);

    }
    public function returnedOrder(Request $request) {
        $order = SaleOrder::find($request->orderId);
        SaleOrder::where('id', $request->orderId)
            ->where('status', OrderStatus::$DELIVERED)
            ->update([
                'status' => OrderStatus::$RETURNED,
                'return_at' => Carbon::now(),
            ]);

        return response()->json(['success' => true, 'message' => 'Order Returned.', 'redirect_url' => route('order.view',['order'=>$order->id])]);

    }
    public function completeOrderOld(Request $request) {
        $order = SaleOrder::find($request->orderId);

        SaleOrder::where('id', $request->orderId)
            ->where('vendor_id', Auth::guard('vendor')->user()->id)
            ->where('status', OrderStatus::$SHIPPED)
            ->update([
                'status' => OrderStatus::$COMPLETED,
                'completed_at' => Carbon::now(),
            ]);
        return response()->json(['success' => true, 'message' => 'Order Completed.', 'redirect_url' => route('admin.order.completed')]);

    }

    public function cancelOrder(Request $request) {
        SaleOrder::where('id', $request->orderId)
            ->update([
                'status' => OrderStatus::$CANCELLED,
                'cancelled_at' => Carbon::now(),
            ]);
        return response()->json(['success' => true, 'message' => 'Order Canceled.']);

    }

    public function saleProductJson(Request $request) {
        if (!$request->searchTerm) {
            $products = Product::where('vendor_id',Auth::guard('vendor')->user()->id)
                        ->where('status', 1)->orderBy('name')->limit(10)->get();
        } else {
            $products = Product::where('vendor_id',Auth::guard('vendor')->user()->id)
                        ->where('status', 1)->where('name', 'like', '%'.$request->searchTerm.'%')
                        ->orderBy('name')->limit(10)->get();
        }

        $data = array();

        foreach ($products as $product) {
            $data[] = [
                'id' => $product->id,
                'text' => $product->name
            ];
        }

        echo json_encode($data);
    }
    public function saleProductDetails(Request $request) {
        $string = $request->productId;
        if ($string[0] != 'p') {
            $product = Product::with('colors','sizes','unit')->find($request->productId);
        }else {
            $packageId = substr($request->productId, 1);
           $product = ProductPackage::find($packageId);
            $product->price = $product->total;
        }

        return response()->json($product);
    }

    public function getOrderDetails(Request $request)
    {
        $order = SaleOrder::where('id',$request->orderId)->first();

        return response()->json($order);
    }

}
