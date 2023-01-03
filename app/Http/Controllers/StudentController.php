<?php

namespace App\Http\Controllers;

use App\Http\Resources\student\profileOverview;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends BaseController
{
    private $studentResource;
    private $profileOverviewResource;
    public $Model;
    
    public function __construct()
    {
        $this->studentResource = new StudentResource(array());
        $this->profileOverviewResource = new profileOverview(array());
        $this->Model = new Student();
    }

    public function index($allowPagination)
    {
        return parent::index($allowPagination);
    }

    public function saveData(Request $request)
    {
        // Insert into user table
        parent::createModelObject("App\Models\User");
        $user = parent::store($request->user_info);

        // Insert into student table
        parent::createModelObject("App\Models\Student");
        $student_info_tmp = array();
        $student_uid = [
            'user_id' => $user->id
        ];
        $student_info_tmp = (array)array_merge($request->student_info, $student_uid);

        $student = parent::store($student_info_tmp);

        // Insert into parent table
        $parent_info = json_decode($request->parent_info, true);
        foreach ($parent_info as $key => $value) {
            parent::createModelObject("App\Models\User");
            $user_info["first_name"] = $value['first_name'];
            $user_info["last_name"] = $value['last_name'];
            $user_info["email"] = $value['email'];
            $user_info["role"] = $value['role'];
            $user = parent::store($user_info);

            parent::createModelObject("App\Models\Guardian");
            $prt_info["full_name"] = $value['full_name'];
            $prt_info["phone"] = $value['phone'];
            $prt_info["user_id"] = $user->id;
            $parent = parent::store($prt_info);

            parent::createModelObject("App\Models\Guardian_Student");
            $grd_std_info["guardian_id"] = $parent->id;
            $grd_std_info["student_id"] = $student->id;
            $guardian_student = parent::store($grd_std_info);
        }

        $this->successResponse($student, 'save successfully');
    }

    public function show($id)
    {
        return parent::show($id);
    }

    // public function update(Request $request, $id)
    // {
    //     return parent::update($request, $id);
    // }

    public function destroy($id)
    {
        return parent::destroy($id);
    }

    public function profileOverview($id)
    {
        $preVal = '';
        $curVal = '';
        $newArr = array();
        $clsArr = array();
        $index = 0;

        $timetables = Student::query()
            ->with(['subject' => function ($query) {
                $query->select('id', 'name');
            }])
            ->with(['teacher.user' => function ($query) {
                $query->select('id', 'email');
            }])
            ->with(['teacher.subject' => function ($query) {
                $query->select('id', 'name');
            }])
            ->with(['teacher' => function ($query) {
                $query->select('id', 'user_id', 'full_name', 'phone');
            }])
            ->with(['classSchedule.teacher' => function ($query) {
                $query->select('id', 'full_name');
            }])
            ->with(['classSchedule' => function ($query) {
                $query->select('class_schedule.id','teacher_id','topic', 'start_date', 'end_date', 'description','duration','selected_day');
            }])
            ->with(['guardian.user' => function ($query) {
                $query->select('id', 'email');
            }])
            ->with(['guardian' => function ($query) {
                $query->select('id', 'user_id', 'full_name', 'phone');
            }])
            ->where('id', $id)->get();
            
        $student = [
            'full_name' => $timetables[0]->full_name,
            'email' => $timetables[0]->user->email,
            'phone' => $timetables[0]->phone,
        ];
       
        foreach ($timetables->pluck('classSchedule')[0] as $key => $value) {
            $curVal = $value->topic;
            if ($curVal != $preVal) {
                $clsArr[$index] = $value;
                $index = $index + 1;
            }
            $preVal = $value->topic;
        }

        $newArr = [
            "student"=>$student,
            "subject"=>$timetables[0]->subject,
            "teacher"=>$timetables[0]->teacher,
            "guardian"=>$timetables[0]->guardian,
            "class_schedule"=>$clsArr
        ];

        return $this->successResponse(
            $this->profileOverviewResource->make($newArr),
            'fetch all record successfully'
        );
    }

    public function teachers($id)
    {
    }

    public function groupDiscussion($id)
    {
    }

    public function Classes($id)
    {
    }

    public function changePassword(Request $request, $id)
    {
    }
}


// code for learning

// $timetableIds = StudentSession::where('student_id',$id)->pluck('class_schedule_id');
// $sub = ClassSchedule::orderBy('id','DESC');
// $timetables = DB::table(DB::raw("({$sub->toSql()}) as sub"))
// ->whereIn('id',$timetableIds)
// ->groupBy('class_unique_id')
// ->get();
// $student = Student::where('id',$id)->first();

// foreach ($timetables as $key => $value) {
//     $subject = Subject::where('id',$value->subject_id)->first();
//     $teacher = Teacher::where('id',$value->teacher_id)->first();
//     $value->subject = $subject->name;
//     $value->teacher = $teacher->full_name;

// }

// return $this->successResponse($timetables, 'fetch record successfully');