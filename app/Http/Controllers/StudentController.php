<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends BaseController
{
    public $model_name = "App\Models\Student";
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
        $student_info['phone'] = $request->student_info['phone'];
        $student_info['dob'] = $request->student_info['dob'];
        $student_info['full_name'] = $request->student_info['full_name'];
        $student_info['country'] = $request->student_info['country'];
        $student_info['user_id'] = $user->id;
        $student = parent::store($student_info);

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

    public function update(Request $request, $id)
    {
        return parent::update($request, $id);
    }

    public function destroy($id)
    {
        return parent::destroy($id);
    }
}
