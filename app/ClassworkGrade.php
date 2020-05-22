<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hrshadhin\Userstamps\UserstampsTrait;

class ClassworkGrade extends Model
{
    use SoftDeletes;
    use UserstampsTrait;
    
    public function question()
    {
        return $this->belongsTo('App\Question', 'classwork_id');
    }

    public function attempt()
    {
        return $this->belongsTo('App\ClassworkAttempt', 'attempt_id');
    }
}
