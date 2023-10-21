<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\InventoryLog;
use App\Models\Product;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryProductController extends Controller
{
    public function subSubCategoryPage($category_slug, $sub_category_slug, $sub_sub_category_slug, Request $request) {

        $category = Category::where('slug', $category_slug)
            ->where('status', 1)
            ->first();

        if (!$category)
            abort(404);

        $subCategory = SubCategory::where('slug', $sub_category_slug)
            ->where('status', 1)
            ->where('category_id', $category->id)
            ->first();

        if (!$subCategory)
            abort(404);

        $subSubCategory = SubSubCategory::where('slug', $sub_sub_category_slug)
            ->where('by_style',1)
            ->where('status', 1)
            ->first();



        if (!$subSubCategory)
            abort(404);



        $productIds = Product::select('id')
            ->where('status', 1)
            ->where('sub_sub_category_id', $subSubCategory->id)
            ->get()->pluck('id')->toArray();


        $colors = [];
        $sizes = [];

        $colorExists = DB::table('color_product')
            ->whereIn('product_id', $productIds)
            ->first();

        $sizeExists = DB::table('product_size')
            ->whereIn('product_id', $productIds)
            ->first();

        if ($colorExists) {
            $colorIds = DB::table('color_product')
                ->whereIn('product_id', $productIds)
                ->pluck('color_id')
                ->toArray();

            $colors = Color::where('status', 1)
                ->whereIn('id',$colorIds)
                ->orderBy('name')
                ->get();
        }

        if ($sizeExists) {
            $sizeIds = DB::table('product_size')
                ->whereIn('product_id', $productIds)
                ->pluck('size_id')
                ->toArray();

            $sizes = Size::where('status', 1)
                ->where('type',1)
                ->whereIn('id',$sizeIds)
                ->orderBy('name')
                ->get();
        }

        $inventoriesProductSizes = Inventory::select('product_id')
            ->pluck('product_id')
            ->toArray();
        $appends = [];
        $query = Product::with('inventory')->whereIn('id',$inventoriesProductSizes);

        $query->where('status', 1);
        $query->where('sub_sub_category_id', $subSubCategory->id);

        if ($request->color && $request->color != '') {
            $colorIds = explode(',', $request->color);

            $query->whereHas('colors', function($q) use ($colorIds) {
                $q->whereIn('color_id', $colorIds);
            });

            $appends['color'] = $request->color;
        }

        if ($request->size && $request->size != '') {
            $sizeIds = explode(',', $request->size);

            $query->whereHas('sizes', function($q) use ($sizeIds) {
                $q->whereIn('size_id', $sizeIds);
            });

            $appends['size'] = $request->size;
        }

        $product = Product::select('id')
            ->where('status', 1)
            ->with('colors', 'sizes')
            ->where('sub_sub_category_id', $subSubCategory->id)
            ->first();
//        dd($product);

        $inventoryColorsId = Inventory::whereIn('color_id',$product->colors->pluck('id'))
            ->where('product_id',$product->id)
            ->pluck('color_id')
            ->toArray();
        $inventoryTypesId = Inventory::whereIn('type_id',$product->types->pluck('id'))
            ->where('product_id',$product->id)
            ->pluck('type_id')
            ->toArray();
        $inventorySizesId = Inventory::whereIn('size_id',$product->sizes->pluck('id'))
            ->where('product_id',$product->id)
            ->pluck('size_id')
            ->toArray();

//        $colors = Color::whereIn('id',$inventoryColorsId)->get();
//        $sizes = Size::whereIn('id',$inventorySizesId)->get();
        $types = Type::whereIn('id',$inventoryTypesId)->get();


        $products = $query->paginate(12);

        return view('frontend.sub_sub_category_page', compact('colors',
            'sizes', 'subSubCategory', 'products', 'appends', 'product','colors','sizes','types'));
    }
    public function viewByLookCategoryPage($category_slug, $sub_category_slug, $sub_sub_category_slug, Request $request){

        $category = Category::where('slug', $category_slug)
            ->where('status', 1)
            ->first();

        if (!$category)
            abort(404);

        $subCategory = SubCategory::where('slug', $sub_category_slug)
            ->where('status', 1)
            ->where('category_id', $category->id)
            ->first();

        if (!$subCategory)
            abort(404);

        $subSubCategory = SubSubCategory::where('slug', $sub_sub_category_slug)
            ->where('by_style',0)
            ->where('status', 1)
            ->first();

        if (!$subSubCategory)
            abort(404);

        $productIds = Product::select('id')
            ->where('status', 1)
            ->where('sub_sub_category_id', $subSubCategory->id)
            ->get()->pluck('id')->toArray();

        $appends = [];
        $collections = [];
        $collectionExists = DB::table('collection_product')
            ->whereIn('product_id', $productIds)
            ->first();


        if ($collectionExists) {
            $collectionIds = DB::table('collection_product')
                ->whereIn('product_id', $productIds)
                ->pluck('collection_id')
                ->toArray();

            $collections = Collection::where('status', 1)
                ->whereIn('id',$collectionIds)
                ->orderBy('sort')
                ->get();

        }

        $query = Product::where('status', 1);

        if ($request->collection && $request->collection != '') {
            $collectionIds = explode(',', $request->collection);

            $query->whereHas('collections', function($q) use ($collectionIds) {
                $q->whereIn('collection_id', $collectionIds);
            });

            $appends['collection'] = $request->collection;
        }
        $products = $query->where('sub_sub_category_id', $subSubCategory->id)
            ->paginate(12);

        return view('frontend.view_by_look_category_page', compact('products',
            'subSubCategory','appends','collections'));

    }

    public function productDetails($slug,Request $request)
    {

        $product = Product::where('slug', $slug)
            //->where('status', 1)
            ->with('colors', 'sizes')
            ->first();


        $defaultColor = $request->color_id ?? null;
        $defaultType = $request->type_id ?? null;
        $defaultSize = $request->size_id ?? null;

        if (!$product)
            abort(404);


        $selectQuery = Inventory::with('color','type','size');

        if ($defaultColor != '' && $defaultType != '' && $defaultSize != ''){
            $selectQuery->where('color_id',$defaultColor)
                        ->where('type_id',$defaultType)
                        ->where('size_id',$defaultSize);

        }else{
            $selectQuery->where('color_id',$request->color_id);

        }

        $selectFirstAttributes = $selectQuery->where('product_id',$product->id)->first();

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


        $customerLikeProducts = array_slice(array_reverse($request->session()->get('session_customer_likes'), true),0, 6);

        if (($key = array_search($customerLikesItem, $customerLikeProducts)) !== false) {
            unset($customerLikeProducts[$key]);
        }
        $customerLikeProducts = json_encode($customerLikeProducts);

        return view('frontend.product_details', compact('product',
            'customerLikeProducts','colors','sizes','defaultColor',
            'getLook','types','selectFirstAttributes'));
    }
    public function viewByLookProductDetails($slug){

        $product = Product::where('slug', $slug)
            ->where('status', 1)
            ->with('colors', 'sizes')
            ->first();

        if (!$product)
            abort(404);




        return view('frontend.view_by_look_product_details', compact('product'));
    }
}
