<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hrshadhin\Userstamps\UserstampsTrait;

class QuizAttempt extends Model
{
    //
    use SoftDeletes;
    use UserstampsTrait;

    public function quiz()
    {
        return $this->belongsTo('App\Quiz', 'quiz_id');
    }

    public function question()
    {
        return $this->belongsTo('App\QuizQuestion', 'question_id');
    }
}
