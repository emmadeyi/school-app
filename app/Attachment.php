<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hrshadhin\Userstamps\UserstampsTrait;

class Attachment extends Model
{

    use SoftDeletes;
    use UserstampsTrait;
    //
}
