<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hrshadhin\Userstamps\UserstampsTrait;

class QuizQuestion extends Model
{
    //
    use SoftDeletes;
    use UserstampsTrait;

    public function quiz()
    {
        return $this->belongsTo('App\Quiz', 'quiz_id');
    }

    public function answer()
    {
        return $this->hasMany('App\QuizAnswer', 'question_id');
    }
}
