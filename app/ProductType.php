<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function itemParts(){
        return $this->hasMany('App\ItemPart', 'item_type_id');
    }
}
