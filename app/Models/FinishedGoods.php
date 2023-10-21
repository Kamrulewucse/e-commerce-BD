<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishedGoods extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function color() {
        return $this->belongsTo(Color::class);
    }
    public function size() {
        return $this->belongsTo(Size::class);
    }
    public function type() {
        return $this->belongsTo(Type::class);
    }
    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }
    public function unit() {
        return $this->belongsTo(Unit::class);
    }
    public function brand() {
        return $this->belongsTo(Brand::class);
    }
    public function product() {
        return $this->belongsTo(Product::class);
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
}
