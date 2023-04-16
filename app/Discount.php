<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $guarded = [];

    public function products(){
        return $this->belongsTo('App\Product', 'product_id');
    }
    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }



}
