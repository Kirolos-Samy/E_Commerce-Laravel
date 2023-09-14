<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false ;

    // Each Product belongs to one and only one category

    function category(){
        return $this->belongsTo(Category::class);
    }


    // function order(){
    //     return $this->hasMany(OrderProduct::class);
    // }
    
    public function getIsActiveAttribute()
    {
        return $this->attributes['active'] === 1;
    }

}
