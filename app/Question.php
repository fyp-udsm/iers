<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function getCourse()
    {
        return $this->belongsTo('App\Course', 'course_id');
    }
}