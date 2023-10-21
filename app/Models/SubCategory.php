<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function subSubCategories() {
        return $this->hasMany(SubSubCategory::class)
            ->where('status', 1)
            ->orderBy('sort');
    }
}
