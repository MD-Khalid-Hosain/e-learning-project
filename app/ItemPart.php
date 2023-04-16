<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemPart extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
    public function itemtype()
    {
        return $this->belongsTo('App\ProductType', 'item_type_id');
    }
}
