<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagazineCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function magazines()
    {
        return $this->hasMany(Magazine::class)
            ->where('status',1)
            ->orderBy('id','desc');
    }
}
