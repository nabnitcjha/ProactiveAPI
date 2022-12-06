<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Http\Resources\ClassScheduleResource;
use App\Models\ClassSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ClassScheduleController extends BaseController
{
    public function __construct()
    {
        $this->classScheduleResource = new ClassScheduleResource(array());
        $this->Model = new ClassSchedule();
    }

    public function index($allowPagination)
    {
        return parent::index($allowPagination);
    }

    public function saveData(Request $request)
    {
        $slotTimes = json_decode($request->class_schedule_info['slotTimes'], true);
        $students = json_decode($request->class_schedule_info['students'], true);
        $session_id = Str::random($length = 10);

        $class_schedule_info['topic']=$request->class_schedule_info['topic'];
        $class_schedule_info['teacher_id']=$request->class_schedule_info['teacher_id'];
        $class_schedule_info['subject_id ']=$request->class_schedule_info['subject_id'];
        $class_schedule_info['description']=$request->class_schedule_info['event_message'];
        $class_schedule_info['selected_day']=$request->class_schedule_info['selected_day'];
        $class_schedule_info['class_repeat']=$request->class_schedule_info['session_repeat'];
        $class_schedule_info['class_unique_id']=$session_id;

        foreach ($slotTimes as $key => $slotTime) {
            $class_schedule_info['start_date']=$request->class_schedule_info['topic'];
            $class_schedule_info['end_date']=$request->class_schedule_info['teacher_id'];
        }
        // Insert into user table
        parent::createModelObject("App\Models\User");
        $user = parent::store($request->user_info);

        // Insert into teacher table
        parent::createModelObject("App\Models\Teacher");
        $teacher_info['phone'] = $request->teacher_info['phone'];
        $teacher_info['dob'] = $request->teacher_info['dob'];
        $teacher_info['full_name'] = $request->teacher_info['full_name'];
        $teacher_info['country'] = $request->teacher_info['country'];
        $teacher_info['user_id'] = $user->id;
        $teacher = parent::store($teacher_info);

        $this->successResponse($teacher, 'save successfully');
    }

    public function show($id)
    {
        return parent::show($id);
    }

    public function update(Request $request, $id)
    {
        return parent::update($request,$id);
    }

    public function destroy($id)
    {
        return parent::destroy($id);
    }
}
