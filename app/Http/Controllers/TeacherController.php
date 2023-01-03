<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends BaseController
{
    public $Model;
    private $teacherResource;
    
    public function __construct()
    {
        $this->teacherResource = new TeacherResource(array());
        $this->Model = new Teacher();
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

    // public function update(Request $request, $id)
    // {
    //     return parent::update($request,$id);
    // }

    public function destroy($id)
    {
        return parent::destroy($id);
    }
}
