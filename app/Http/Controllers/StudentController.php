<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends BaseController
{
    public function __construct()
    {
        $this->studentResource = new StudentResource(array());
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
        $student_info_tmp=array();
        $student_uid = [
            'user_id'=>$user->id
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

    public function profileOverview($id){
        $id = 1;
    }

    public function teachers($id){
        
    }

    public function groupDiscussion($id){
        
    }

    public function Classes($id){
        
    }

    public function changePassword(Request $request,$id){
        
    }
}
