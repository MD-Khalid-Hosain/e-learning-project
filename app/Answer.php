<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded = [];
    public function question(){
        return $this->hasMany('App\Answer', 'question_id');
    }
}
