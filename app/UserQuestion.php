<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserQuestion extends Model
{
    protected $guarded = [];
    public function product(){
        return $this->belongsTo('App\Product', 'product_id');
    }
    public function admin(){
        return $this->belongsTo('App\EcomUser', 'admin_id');
    }
}
