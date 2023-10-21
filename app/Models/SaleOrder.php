<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleOrder extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function country() {
        return $this->belongsTo(Country::class);
    }
    public function city() {
        return $this->belongsTo(City::class);
    }
    public function state() {
        return $this->belongsTo(State::class,'city');
    }
    public function area() {
        return $this->belongsTo(Area::class);
    }
    public function customer()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function address()
    {
        return $this->belongsTo(AddressBook::class,'address_books_id','id');
    }

    public function products()
    {
        return $this->hasMany(ProductSaleOrder::class);
    }
    public function totalQuantity()
    {
        return $this->hasMany(ProductSaleOrder::class)->sum('quantity');
    }
    public function totalWeight()
    {
        return $this->hasMany(ProductSaleOrder::class)->sum('product_weight');
    }

    public function getProductNamesAttribute(){
        $products = ProductSaleOrder::where('sale_order_id', $this->id)->get();
        foreach($products as $product){
            return $product->name.'-';
        }
    }
}
