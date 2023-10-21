<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $guarded = [];

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }
    public function colors() {
        return $this->belongsToMany(Color::class);
    }
    public function collections() {
        return $this->belongsToMany(Collection::class);
    }

    public function sizes() {
        return $this->belongsToMany(Size::class);
    }
    public function types() {
        return $this->belongsToMany(Type::class);
    }
    public function colorImages()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function colorVideos()
    {
        return $this->hasMany(ProductVideo::class);
    }
    public function unit() {
        return $this->belongsTo(Unit::class);
    }
    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function subCategory() {
        return $this->belongsTo(SubCategory::class);
    }

    public function subSubCategory() {
        return $this->belongsTo(SubSubCategory::class);
    }

    public function productFirstImage()
    {
        return $this->hasOne(ProductImage::class,'product_id','id');
    }

}
