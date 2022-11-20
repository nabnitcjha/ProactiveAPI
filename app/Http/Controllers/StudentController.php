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
        $student_info["user_id"] = $user->id;
        $request->request->add(['student_info' => $student_info]); 
        $student = parent::store($request->student_info);

        // Insert into parent table
        foreach ($request->parent_info_info as $key => $value) {
            parent::createModelObject("App\Models\User");
            $user_info["first_name"] = $value->first_name;
            $user_info["last_name"] = $value->last_name;
            $user_info["email"] = $value->email;
            $user_info["role"] = $value->role;
            $user = parent::store($user_info);

            parent::createModelObject("App\Models\Parent");
            $parent_info["full_name"] = $value->full_name;
            $parent_info["phone"] = $value->phone;
            $parent_info["user_id"] = $user->user_id;
            $parent = parent::store($parent_info);
        }

        $this->successResponse($user,'save successfully');
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
