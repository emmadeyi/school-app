<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hrshadhin\Userstamps\UserstampsTrait;

class ClassworkAttempt extends Model
{

    use SoftDeletes;
    use UserstampsTrait;
    
    public function question()
    {
        return $this->belongsTo('App\Question', 'classwork_id');
    }

    public function grade()
    {
        return $this->belongsTo('App\ClassworkGrade', 'attempt_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
}
