<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecificationHeader extends Model
{
    protected $guarded = [];

    public function titeldescription()
    {
        return $this->hasMany('App\TitleDescOfSpecification', 'header_id');
    }
}
