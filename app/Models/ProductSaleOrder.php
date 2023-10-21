<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSaleOrder extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function colors() {
        return $this->belongsToMany(Color::class);
    }

    public function sizes() {
        return $this->belongsToMany(Size::class);
    }
}
