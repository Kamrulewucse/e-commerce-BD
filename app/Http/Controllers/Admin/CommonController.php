<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Library\Ecourier\Facade\Ecourier;
use App\Library\Pathao\Facade\PathaoCourier;
use App\Models\AccountHeadSubType;
use App\Models\AccountHeadType;
use App\Models\BankAccount;
use App\Models\Branch;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\SubSubCategory;
use App\Models\Type;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class CommonController extends Controller
{
    public function getMegaMenu(Request $request)
    {
        $category = Category::where('id',$request->categoryId)
            ->with('subcategories')
            ->first();

        $html = view('layouts.partial.mega_menu',compact('category'))->render();
        $preload = view('layouts.partial.mega_preload')->render();

        return response([
            'menu'=>$html,
            'preload'=>$preload,
        ]);
    }
    public function getSubSubMenu(Request $request)
    {
        $subSubCategories = SubSubCategory::where('sub_category_id',$request->subCategoryId)
            ->orderBy('sort')
            ->get();

        $html = view('layouts.partial.mega_sub_sub_menu',compact('subSubCategories'))->render();

        if(count($subSubCategories) > 0 && $subSubCategories[0] && $subSubCategories[0]->thumbs)
            $img = asset($subSubCategories[0]->thumbs);
        else
            $img = asset('img/category.jpg');

        return response([
            'menu'=>$html,
            'img'=>$img,
        ]);
    }
    public function getSubSubSubCategoryImg(Request $request)
    {
        $subSubCategory = SubSubCategory::where('id',$request->subSubCategoryId)
            ->first();

        if($subSubCategory->thumbs)
            $img = asset($subSubCategory->thumbs);
        else
            $img = asset('img/category.jpg');

        return response($img);
    }
    public function getProductDetailsAjax(Request $request)
    {

        $product = Product::find($request->productId);
        $color = Color::find($request->colorId);
        $size = Size::find($request->selectSizeId);
        $type = Type::find($request->selectTypeId);


        $inventoryColorsId = Inventory::whereIn('color_id',$product->colors->pluck('id'))
            ->whereIn('type_id',$product->types->pluck('id'))
            ->whereIn('size_id',$product->sizes->pluck('id'))
            ->where('product_id',$product->id)
            ->pluck('color_id')
            ->toArray();

        $inventorySizesId = Inventory::whereIn('size_id',$product->sizes->pluck('id'))
            ->whereIn('color_id',$product->colors->pluck('id'))
            ->whereIn('type_id',$product->types->pluck('id'))
            ->where('product_id',$product->id)
            ->pluck('size_id')
            ->toArray();
        $inventoryTypesId = Inventory::whereIn('type_id',$product->types->pluck('id'))
            ->whereIn('size_id',$product->sizes->pluck('id'))
            ->whereIn('color_id',$product->colors->pluck('id'))
            ->where('product_id',$product->id)
            ->pluck('type_id')
            ->toArray();


        if ($request->isType == 1){
            $selectFirstAttributes = Inventory::with('color','type','size')
                ->where('color_id',$request->colorId)
                ->where('size_id',$request->selectSizeId)
                ->where('type_id',$request->selectTypeId)
                ->where('product_id',$product->id)
                ->first();

            if (!$selectFirstAttributes){
                $selectFirstAttributes = Inventory::with('color','type','size')
                    ->where('type_id',$request->selectTypeId)
                    ->where('product_id',$product->id)
                    ->first();
            }

            $inventoryColorsId = Inventory::where('product_id',$product->id)
                ->pluck('color_id')
                ->toArray();

            $inventorySizesId = Inventory::where('color_id',$selectFirstAttributes->color_id)
                ->where('type_id',$selectFirstAttributes->type_id)
                ->where('product_id',$product->id)
                ->pluck('size_id')
                ->toArray();

            $inventoryTypesId = Inventory::where('color_id',$selectFirstAttributes->color_id)
                ->where('product_id',$product->id)
                ->pluck('type_id')
                ->toArray();

        }elseif ($request->isType == 0){

            $selectFirstAttributes = Inventory::with('color','type','size')
                ->where('color_id',$request->colorId)
                ->where('size_id',$request->selectSizeId)
                ->where('type_id',$request->selectTypeId)
                ->where('product_id',$product->id)
                ->first();

            if (!$selectFirstAttributes){
                $selectFirstAttributes = Inventory::with('color','type','size')
                    ->where('color_id',$request->colorId)
                    ->where('product_id',$product->id)
                    ->first();
            }

            $inventoryColorsId = Inventory::where('product_id',$product->id)
                ->pluck('color_id')
                ->toArray();

            $inventorySizesId = Inventory::where('color_id',$selectFirstAttributes->color_id)
                ->where('type_id',$selectFirstAttributes->type_id)
                ->where('product_id',$product->id)
                ->pluck('size_id')
                ->toArray();

            $inventoryTypesId = Inventory::where('color_id',$selectFirstAttributes->color_id)
                ->where('size_id',$selectFirstAttributes->size_id)
                ->where('product_id',$product->id)
                ->pluck('type_id')
                ->toArray();
        }

        $colors = Color::whereIn('id',$inventoryColorsId)->get();
        $sizes = Size::whereIn('id',$inventorySizesId)->get();
        $types = Type::whereIn('id',$inventoryTypesId)->get();

        $includeProductIndex = $product->id.'-'.$selectFirstAttributes->color_id.'-'.$selectFirstAttributes->type_id;
        $getLook = Product::where('type',2)
            ->whereJsonContains('include_products',["$includeProductIndex"])
            ->first();

        $customerLikesItem = [
            'id' => $selectFirstAttributes->product_id.'-'.$selectFirstAttributes->color_id.'-'.$selectFirstAttributes->type_id.'-'.$selectFirstAttributes->size_id,
            'name' => $product->name.'-'.getColor($selectFirstAttributes->color_id)->name.(getTypeName($selectFirstAttributes->type_id)->id != 1 ? '-'.getTypeName($selectFirstAttributes->type_id)->name : ''),
            'slug' => $product->slug,
            'attributes' => [
                'product_id' => $selectFirstAttributes->product_id,
                'color_id' => $selectFirstAttributes->color_id,
                'type_id' => $selectFirstAttributes->type_id,
                'size_id' => $selectFirstAttributes->size_id,
            ],
        ];
        $sessionCustomerLikes = $request->session()->get('session_customer_likes');
        if ($sessionCustomerLikes){
            if (!in_array($customerLikesItem,$sessionCustomerLikes)){
                array_push($sessionCustomerLikes,$customerLikesItem);
                Session::put('session_customer_likes',$sessionCustomerLikes);
            }
        }else{
            Session::put('session_customer_likes',[$customerLikesItem]);
        }
        $customerLikeProducts = array_slice(array_reverse($request->session()->get('session_customer_likes'), true),0, 5);

        if (($key = array_search($customerLikesItem, $customerLikeProducts)) !== false) {
            unset($customerLikeProducts[$key]);
        }
        $customerLikeProducts = json_encode($customerLikeProducts);


        $htmlImg = view('layouts.partial.product_details_ajax',compact('product','color','type','size','colors','sizes','types','selectFirstAttributes'))->render();
        $htmlCarousel = view('layouts.partial.ajax_product_details_carousel',compact('product','color','size','type','selectFirstAttributes'))->render();
        $htmlColorDetails = view('layouts.partial.ajax_product_color_details',compact('product','color','size','type','selectFirstAttributes'))->render();
        $htmlTopNavBar = view('layouts.partial.ajax_sticky_product_bar',compact('product','color','size','type','selectFirstAttributes'))->render();
        $htmlColorSideBar = view('layouts.partial.ajax_color_side_bar',compact('product','color','size','type','selectFirstAttributes','colors'))->render();
        $htmlTypeSideBar = view('layouts.partial.ajax_type_side_bar',compact('product','color','size','type','selectFirstAttributes','types'))->render();
        $htmlLookAndIncludeProducts = view('layouts.partial.ajax_look_and_include_products',compact('getLook'))->render();

        return response([
            'product_section_1'=>$htmlImg,
            'product_section_2'=>$htmlCarousel,
            'product_section_3'=>$htmlColorDetails,
            'product_section_4'=>$htmlTopNavBar,
            'product_section_5'=>$htmlColorSideBar,
            'product_section_6'=>$htmlTypeSideBar,
            'product_section_7'=>$htmlLookAndIncludeProducts,
        ]);
    }
    public function getSearchData(Request $request)
    {
        $products = Product::where('type',1)->where('name', 'like', '%' .$request->keyWord. '%')
                    ->take(4)
                    ->get();

        if ($request->keyWord == ''){
            $products = Product::where('type',1)->take(4)->get();
        }
        $categories = Category::orderBy('sort')->get();

        $subSubCategories = SubSubCategory::where('by_style',1)->where('name', 'like', '%' .$request->keyWord. '%')
                            ->get();

        $html = view('layouts.partial.product_search_result',compact('products','categories',
        'subSubCategories'))->render();

        return response($html);
    }

    public function getBranch(Request $request) {
        $branches = Branch::where('bank_id', $request->bankId)
            ->where('status', 1)
            ->orderBy('name')
            ->get()->toArray();

        return response()->json($branches);
    }

    public function getBankAccount(Request $request) {
        $accounts = BankAccount::where('branch_id', $request->branchId)
            ->where('status', 1)
            ->orderBy('account_no')
            ->get()->toArray();

        return response()->json($accounts);
    }

    public function orderDetails(Request $request) {
        $order = SalesOrder::where('id', $request->orderId)->with('customer')->first()->toArray();

        return response()->json($order);
    }

    public function getAccountHeadType(Request $request) {
        $types = AccountHeadType::where('transaction_type', $request->type)
            ->where('status', 1)
            ->orderBy('name')
            ->get()->toArray();

        return response()->json($types);
    }

    public function getAccountHeadSubType(Request $request) {
        $subTypes = AccountHeadSubType::where('account_head_type_id', $request->typeId)
            ->where('status', 1)
            ->orderBy('name')
            ->get()->toArray();

        return response()->json($subTypes);
    }

    public function getSerialSuggestion(Request $request) {
        if ($request->has('term')) {
            return DB::table('purchase_order_purchase_product')->where('serial_no', 'like', '%'.$request->input('term').'%')->get();
        }
    }

    public function vatCorrection() {
        $orders = SalesOrder::where('vat_percentage', '!=', 0)->get();

        foreach ($orders as $order) {
            $total = $order->sub_total + $order->vat - $order->discount;
            $order->total = $total;

            if ($order->due == 0) {
                $order->paid = $total;
            } else {
                $order->due = $total;
            }

            $order->save();
        }
    }
    public function getSubCategory(Request $request) {
        $subcategory = SubCategory::where('category_id', $request->categoryID)
            ->where('status', 1)
            ->orderBy('name')
            ->get()->toArray();

        return response()->json($subcategory);
    }
    public function getSubSubCategory(Request $request) {

        $subcategory = SubSubCategory::where('sub_category_id', $request->subCategoryID)
            ->where('status', 1)
            ->orderBy('name')
            ->get()->toArray();

        return response()->json($subcategory);
    }
    public function getEcourierApiCity() {
        $cities = Ecourier::area()->city();
        return response()->json($cities);
    }

    public function getEcourierApiThana(Request $request) {
        $thana = Ecourier::area()->thana($request->cityName);

        return response()->json($thana);
    }
    public function getEcourierApiPostcode(Request $request) {
        $postCodes = Ecourier::area()->postcode($request->cityName,$request->thanaName);
        //dd($postCodes);
        return response()->json($postCodes);
    }
    public function getEcourierApiArea(Request $request) {
        $areas = Ecourier::area()->areaList($request->postcode);
        return response()->json($areas);
    }
    public function getEcourierApiPackage() {
        $packages = Ecourier::order()->packageList();
        return response()->json($packages);
    }
    public function getPathaoApiCity() {

        $cities = PathaoCourier::area()->city()->data;

        return response()->json($cities);
    }
    public function getPathaoApiStore(Request $request) {

        $stores = PathaoCourier::store()->list()->data;

        return response()->json($stores);
    }
    public function getPathaoApiZone(Request $request) {

        $zones = PathaoCourier::area()->zone($request->cityId)->data;

        return response()->json($zones);
    }
    public function getPathaoApiArea(Request $request) {

        $areas = PathaoCourier::area()->area($request->zoneId)->data;

        return response()->json($areas);
    }
    public function getColors(Request $request) {

        $product = Product::where('id', $request->productId)
            ->first();

        return response()->json($product->colors);
    }
    public function getTypes(Request $request) {

        $product = Product::where('id', $request->productId)
            ->first();

        return response()->json($product->types);
    }
    public function getProduct(Request $request) {

        $products = Product::where('sub_sub_category_id',$request->subSubCategoryID)
            ->where('status', 1)
            ->orderBy('name')
            ->get()->toArray();

        return response()->json($products);
    }
    public function getBrand(Request $request) {

        $product = Product::with('brand')
            ->select('id','brand_id')
            ->where('id',$request->productId)
            ->where('status', 1)
            ->first();

        return response()->json($product);
    }

    public function getProductCode(Request $request) {

        $product = PurchaseProduct::where('id', $request->productID)->first();

        return response()->json($product);
    }
    public function getDesignation(Request $request) {
        $designations = Designation::where('department_id', $request->departmentId)
            ->where('status', 1)
            ->orderBy('name')->get()->toArray();

        return response()->json($designations);
    }

    public function getEmployeeDetails(Request $request) {
        $employee = Employee::where('id', $request->employeeId)
            ->with('department', 'designation')->first();

        return response()->json($employee);
    }

    public function getMonth(Request $request) {
        $salaryProcess = SalaryProcess::select('month')
            ->where('year', $request->year)
            ->get();

        $proceedMonths = [];
        $result = [];

        foreach ($salaryProcess as $item)
            $proceedMonths[] = $item->month;

        for($i=1; $i <=12; $i++) {
            if (!in_array($i, $proceedMonths)) {
                $result[] = [
                    'id' => $i,
                    'name' => date('F', mktime(0, 0, 0, $i, 10)),
                ];
            }
        }

        return response()->json($result);
    }

   public function getMonthSalaryMonth(Request $request) {

        $salaryProcess = SalaryProcess::select('month')
            ->where('year', $request->year)
            ->get();

        $proceedMonths = [];
        $result = [];

        foreach ($salaryProcess as $item)
            $proceedMonths[] = $item->month;

        for($i=1; $i <=12; $i++) {
            if (in_array($i, $proceedMonths)) {
                $result[] = [
                    'id' => $i,
                    'name' => date('F', mktime(0, 0, 0, $i, 10)),
                ];
            }
        }

        return response()->json($result);
    }
}
