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
        // $student_info = $request('student_info');
        // return $request;
        return parent::store($request->student_info);
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
