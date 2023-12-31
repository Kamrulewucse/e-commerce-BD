<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = [
        'city_id', 'name', 'bn_name', 'lat', 'long'
    ];

    public function city() {
        return $this->belongsTo(City::class);
    }
}
