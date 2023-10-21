<?php

use App\Enumeration\Role;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVideo;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

if (! function_exists('format_price')) {
    function format_price($price)
    {
        $num = floatval($price).'';
        if (strpos($num, '.') !== false)
            return number_format($price, 2, '.', ',');
        else
            return number_format($price);
    }
}

if (! function_exists('getPriceCurrency')) {
    function getPriceCurrency($productId,$colorId,$typeId,$sizeId)
    {
        $inventory = Inventory::where('product_id',$productId)
            ->where('color_id',$colorId)
            ->where('type_id',$typeId)
            ->where('size_id',$sizeId)
            ->first();
        $price = '';
        if ($inventory){
            $setting = Setting::first();

            $getCurrency = session()->get('currency');
            $price = (number_format($inventory->selling_unit_price,2)).' BDT';

            if ($getCurrency == 'usd')
                $price = '$'.(number_format($inventory->selling_unit_price / $setting->dollor,2));
            elseif($getCurrency == 'bdt')
                $price = (number_format($inventory->selling_unit_price / $setting->bdt,2)).' BDT';
            elseif($getCurrency == 'aed')
                $price = (number_format($inventory->selling_unit_price / $setting->aed,2)).' AED';

        }

        return $price;
    }
}
if (! function_exists('getPriceCurrencyProduct')) {
    function getPriceCurrencyProduct($productId)
    {
        $inventory = Inventory::where('product_id',$productId)
            ->first();
        $price = '';
        if ($inventory){
            $setting = Setting::first();

            $getCurrency = session()->get('currency');
            $price = (number_format($inventory->selling_unit_price,2)).' BDT';

            if ($getCurrency == 'usd')
                $price = '$'.(number_format($inventory->selling_unit_price / $setting->dollor,2));
            elseif($getCurrency == 'bdt')
                $price = (number_format($inventory->selling_unit_price / $setting->bdt,2)).' BDT';
            elseif($getCurrency == 'aed')
                $price = (number_format($inventory->selling_unit_price / $setting->aed,2)).' AED';

        }

        return $price;
    }
}
if (! function_exists('getProductStock')) {
    function getProductStock($productId,$colorId,$typeId,$sizeId)
    {
        $inventory = Inventory::where('product_id', $productId)
            ->where('color_id', $colorId)
            ->where('type_id', $typeId)
            ->where('size_id', $sizeId)
            ->first();

        if ($inventory) {
            return $inventory->quantity;
        } else {
            return 0;
        }

    }
}
if (! function_exists('convertNormalCurrency')) {
    function convertNormalCurrency($price)
    {

        $setting = Setting::first();

        $getCurrency = session()->get('currency');

        if ($getCurrency == 'usd')
            $price = $price / $setting->dollor;
        elseif($getCurrency == 'bdt')
            $price = $price / $setting->bdt;
        elseif($getCurrency == 'aed')
            $price = $price / $setting->aed;

        return $price;
    }
}
if (! function_exists('checkSizeType')) {
    function checkSizeType($id)
    {

        return \App\Models\Size::where('id',$id)->first() ?? null;
    }
}
if (! function_exists('checkType')) {
    function checkType($id)
    {

        return \App\Models\Type::where('id',$id)->first() ?? null;
    }
}
if (! function_exists('checkCustomType')) {
    function checkCustomType($id)
    {

        return \App\Models\Type::where('id',$id)->first() ?? null;
    }
}
if (! function_exists('convertCurrency')) {
    function convertCurrency($productId,$colorId,$sizeId)
    {
        $inventory = Inventory::where('product_id',$productId)
            ->where('color_id',$colorId)
           // ->where('type_id',$typeId)
            ->where('size_id',$sizeId)
            ->first();


        $setting = Setting::first();

        $getCurrency = session()->get('currency');
        $price = $inventory->selling_unit_price ?? 0;

        if ($getCurrency == 'usd')
            $price = ($inventory->selling_unit_price ?? 1) / $setting->dollor;
        elseif($getCurrency == 'bdt')
            $price = ($inventory->selling_unit_price ?? 1) / $setting->bdt;
        elseif($getCurrency == 'aed')
            $price = ($inventory->selling_unit_price ?? 1) / $setting->aed;

        return $price;
    }
}
if (! function_exists('convertCurrencyFlat')) {
    function convertCurrencyFlat($price)
    {



        $setting = Setting::first();

        $getCurrency = session()->get('currency');

        if ($getCurrency == 'usd')
            $price = ($price) / $setting->dollor;
        elseif($getCurrency == 'bdt')
            $price = ($price) / $setting->bdt;
        elseif($getCurrency == 'aed')
            $price = ($price) / $setting->aed;

        return $price;
    }
}
if (! function_exists('convertCurrencySign')) {
    function convertCurrencySign($price)
    {


        $getCurrency = session()->get('currency');

        if ($getCurrency == 'usd')
            $price = '$'.(number_format($price,2));
        elseif($getCurrency == 'bdt')
            $price = (number_format($price,2)).' BDT';
        elseif($getCurrency == 'aed')
            $price = (number_format($price,2)).' AED';

        return $price;
    }
}
if (! function_exists('colorFirstImage')) {
    function colorFirstImage($productId,$colorId)
    {
        return ProductImage::where('product_id',$productId)
            ->where('color_id',$colorId)->first();
    }
}
if (! function_exists('colorImages')) {
    function colorImages($productId,$colorId)
    {
        return ProductImage::where('product_id',$productId)
            ->where('color_id',$colorId)->get();
    }
}
if (! function_exists('colorTypeVideo')) {
    function colorTypeVideo($productId,$colorId,$typeId)
    {

        return ProductVideo::where('product_id',$productId)
            ->where('color_id',$colorId)
            ->where('type_id',$typeId)
            ->first();
    }
}
if (! function_exists('colorTypeImages')) {
    function colorTypeImages($productId,$colorId,$typeId)
    {
        return ProductImage::where('product_id',$productId)
            ->where('color_id',$colorId)
            ->where('type_id',$typeId)
            ->get();
    }
}
if (! function_exists('productImages')) {
    function productImages($productId)
    {
        return ProductImage::where('product_id',$productId)
                    ->get();
    }
}
if (!function_exists('wishlistCheck')) {
    function wishlistCheck($productId,$colorId,$typeId,$sizeId)
    {

        $user = Auth::user();
        if (auth()->check() && $user->role == Role::$BUYER) {
                $wishlists = json_decode($user->wishlist);

                $container = false;
                foreach ($wishlists as $key) {
                    if ($key->id == $productId.'-'.$colorId.'-'.$typeId.'-'.$sizeId) {
                        $container = true;
                    }
                }
                return $container;

        }else{
            $container = false;
            if (session()->get('session_wishlist')){
                $wishlists = json_encode(session()->get('session_wishlist'));
                $wishlists = json_decode($wishlists);

                foreach ($wishlists as $key) {
                    if ($key->id == $productId.'-'.$colorId.'-'.$typeId.'-'.$sizeId) {
                        $container = true;
                    }
                }
            }

            return $container;
        }
    }
}
if (!function_exists('getIncludeProducts')) {
    function getIncludeProducts($productsId)
    {

        $explodeProduct = explode('-',$productsId);

        return Inventory::where('product_id',$explodeProduct[0] ?? null)
                    ->where('color_id',$explodeProduct[1] ?? null)
                    ->where('type_id',$explodeProduct[2] ?? null)
                    ->first();
    }
}
if (!function_exists('getProductGroupByColors')) {
    function getProductGroupByColors($productsId)
    {
        $colors = DB::table('color_product')->select('color_id')->where('product_id',$productsId)->groupBy('color_id')->pluck('color_id');
           if($colors){
              return \App\Models\Color::whereIn('id',$colors->toArray())->get();

           } else{
               return [];
           }

    }
}
if (!function_exists('getColor')) {
    function getColor($id)
    {
       return \App\Models\Color::find($id);

    }
}
if (!function_exists('getTypeName')) {
    function getTypeName($id)
    {
        return \App\Models\Type::find($id);

    }
}
if (!function_exists('getInventoryFirstSize')) {
    function getInventoryFirstSize($productId,$colorId,$typeId)
    {
        return Inventory::where('product_id',$productId)
                ->where('color_id',$colorId)
                ->where('type_id',$typeId)
                ->first();

    }
}
