<?php

namespace App;


use App\Http\Helpers\AppHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hrshadhin\Userstamps\UserstampsTrait;

class Assignment extends Model
{
    use SoftDeletes;
    use UserstampsTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'code',
        'type',
        'points',
        'instructions',
        'due_date',
        'class_id',
        'teacher_id',
        'subject_id',
        'topic_id',
        'status',
        'archive',
    ];


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

    public function marks()
    {
        return $this->hasMany('App\Mark', 'subject_id');
    }
}
