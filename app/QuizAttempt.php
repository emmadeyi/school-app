<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class QuizAttempt extends Model
{
    public function quiz()
    {
        return $this->belongsTo('App\Quiz', 'quiz_id');
    }

    public function question()
    {
        return $this->belongsTo('App\QuizQuestion', 'question_id');
    }
}
