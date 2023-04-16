<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TitleDescOfSpecification extends Model
{
    protected $guarded = [];
    public function specificationHeader()
    {
        return $this->belongsTo('App\SpecificationHeader', 'header_id');
    }
}
