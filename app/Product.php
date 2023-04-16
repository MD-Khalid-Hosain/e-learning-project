<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Product extends Model
{
    use Searchable;

    public function searchableAs()
    {
        return 'product_name';
    }
    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function section(){
        return $this->belongsTo('App\Section', 'section_id');
    }
    public function brand(){
        return $this->belongsTo('App\Brand', 'brand_id');
    }

    public function productFetures(){
        return $this->hasMany('App\ProductFetures');
    }

    public function filterItems(){
        return $this->hasMany('App\FilteringItem', 'product_id');
    }

    public function admin(){
        return $this->belongsTo('App\Admin', 'admin_id');
    }
    public function review(){
        return $this->hasMany('App\Review', 'product_id');
    }
    public function question(){
        return $this->hasMany('App\UserQuestion', 'product_id');
    }
    public function offer(){
        return $this->belongsTo('App\Offer', 'offer_id');
    }

    protected $guarded = [];

    public function scopeOfferProduct($query)
    {
        return $query->where('status', 1);
    }



}
