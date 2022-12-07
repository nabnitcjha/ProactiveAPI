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

            $class_schedule_info = [
                'start_date'=>$slotTime['startDate'],
                'end_date'=>$slotTime['endDate'],
                'class_unique_id'=>$session_id
            ];

            $arrayTemp = (array)array_merge($request->class_schedule_info, $class_schedule_info);
            
            $teacher = parent::store($arrayTemp);
            parent::createModelObject("App\Models\ClassSchedule");
        }
        // Insert into user table
        // parent::createModelObject("App\Models\User");
        // $user = parent::store($request->user_info);
        // $this->successResponse($teacher, 'save successfully');
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
