<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function classSchedule()
    {
        return $this->belongsToMany(ClassSchedule::class, 'student_sessions','student_id' ,'class_schedule_id');
    }
}
