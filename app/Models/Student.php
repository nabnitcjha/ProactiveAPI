<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function classSchedule()
    {
        return $this->belongsToMany(ClassSchedule::class, 'student_sessions', 'student_id', 'class_schedule_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guardian()
    {
        return $this->belongsToMany(Guardian::class, 'guardian_students', 'student_id', 'guardian_id');
    }

    public function subject()
    {
        return $this->belongsToMany(Subject::class, 'student_subjects', 'student_id', 'subject_id');
    }

    public function teacher()
    {
        return $this->belongsToMany(Teacher::class, 'student_teachers', 'student_id', 'teacher_id');
    }

    // public function user()
    // {
    //     return $this->belongsTo('User')->select(['id', 'username']);
    // }
}
