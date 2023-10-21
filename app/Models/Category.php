<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'sort', 'status'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */


    public function subCategories() {

        return $this->hasMany(SubCategory::class)->where('status', 1)
            ->orderBy('sort')
            ->with('subSubCategories');
    }
    public function subSubCategories() {

        return $this->hasMany(SubSubCategory::class)->where('status', 1)
                                ->orderBy('sort');
    }
    public function latestProducts() {
        return $this->hasMany(Product::class)->where('status', 1)->take(20);
    }
    public function inventoryProducts() {
        return $this->hasMany(PurchaseInventory::class)->take(20)->with('product');
    }
}
