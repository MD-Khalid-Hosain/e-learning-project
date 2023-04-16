<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    public function exam(){
        return $this->belongsTo('App\ExamEvent', 'exam_id');
    }
    public function answer(){
        return $this->belongsTo('App\Answer', 'question_id');
    }

}
