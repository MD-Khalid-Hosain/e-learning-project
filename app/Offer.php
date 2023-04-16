<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $guarded = [];

    public function scopeOffers($query){
        return $query->where('status', 1)->orderBy('id', 'DESC');
    }

    public function product()
    {
        return $this->hasMany('App\Product', 'offer_id');
    }

}
