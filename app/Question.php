<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hrshadhin\Userstamps\UserstampsTrait;

class Question extends Model
{
    use SoftDeletes;
    use UserstampsTrait;

    public function teacher()
    {
        return $this->belongsTo('App\Employee', 'teacher_id');
    }

    public function class()
    {
        return $this->belongsTo('App\IClass', 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject', 'subject_id');
    }

    public function topic()
    {
        return $this->belongsTo('App\Topic', 'topic_id');
    }

    public function answer()
    {
        return $this->hasMany('App\Answer', 'type_id');
    }

    public function attempt()
    {
        return $this->hasMany('App\ClassworkAttempt', 'classwork_id');
    }

    public function grade()
    {
        return $this->hasMany('App\ClassworkGrade', 'classwork_id');
    }
}
