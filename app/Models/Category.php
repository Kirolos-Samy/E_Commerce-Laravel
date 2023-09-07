<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Each Category has MANY products
    //             1 -- Many

    function products(){
        return $this->hasMany(Product::class);
    }
}
