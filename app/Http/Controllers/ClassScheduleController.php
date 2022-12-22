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
        $arrayTemp = array();

        $slotTimes = json_decode($request->class_slot_info['slotTimes'], true);
        $students = json_decode($request->class_student_info['students'], true);
        $session_id = Str::random($length = 10);

        foreach ($slotTimes as $key => $slotTime) {
            parent::createModelObject("App\Models\ClassSchedule");
            $class_schedule_info = [
                'start_date'=>$slotTime['startDate'],
                'end_date'=>$slotTime['endDate'],
                'class_unique_id'=>$session_id
            ];

            $arrayTemp = (array)array_merge($request->class_schedule_info, $class_schedule_info);

            $class_schedule = parent::store($arrayTemp);

            // insert into student_session table
            foreach ($students as $key => $student) {
                parent::createModelObject("App\Models\StudentSession");
                $student_info["student_id"] = $student['id'];
                $student_info["class_schedule_id"] = $class_schedule->id;
                parent::store($student_info);
            }
        }
    }

    public function show($id)
    {
        return parent::show($id);
    }

    public function dragUpdate(Request $request, $id)
    {
        // dd($id);
        // return 'sonu kumar jha';
        $drag_info=array();
        $drag_info['start_date']=$request['start_date'];
        $drag_info['end_date']=$request['end_date'];
        return parent::update($drag_info,$id);
    }

    public function destroy($id)
    {
        return parent::destroy($id);
    }
}
