<?php

namespace App\Http\View\Composers;

use App\Enumeration\Role;
use App\Models\Tracker;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Cart;

class FrontComposer
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
        $categories = Category::where('status', 1)
            ->orderBy('sort')
            ->with('subCategories')
            ->get();

        $products = Product::where('type',1)->where('status', 1)
            ->take(4)
            ->get();
        $currentLocale = \Session::get('locale');
        $currentLanguageCurrency = \Session::get('language_currency');
        $cartItems = Cart::getContent();
        $subTotal = convertNormalCurrency(Cart::getSubTotal());

        if (Auth::check() && Auth::user()->role == Role::$BUYER){
            $wishlistCount = count(json_decode(Auth::user()->wishlist));
        }else{
            $wishlistCount = session()->get('session_wishlist') ? count(session()->get('session_wishlist')) : 0;
        }

        $data = [
            'categories' => $categories,
            'cartTotalQuantity' => Cart::getTotalQuantity(),
            'cartItems' => Cart::getContent(),
            'cartSubTotal' => Cart::getSubTotal(),
            'wishlistCount' =>$wishlistCount,
            'products' =>$products,
            'current_locale' =>$currentLocale,
            'language_currency' =>$currentLanguageCurrency,
            'cart_items' =>$cartItems,
            'sub_total' =>$subTotal,
        ];

//        $data['total_visitor'] = Tracker::count();
//        $data['today_visitor'] = Tracker::where('visit_date',date('Y-m-d'))->count();
//        $data['month_visitor'] = Tracker::whereMonth('visit_date',date('m')-1)->count();

        $view->with('layoutData', $data);
    }
}
