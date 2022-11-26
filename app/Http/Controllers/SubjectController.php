<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubjectController extends BaseController
{
    public $model_name = "App\Models\Subject";

    public function index($allowPagination)
    {
        return parent::index($allowPagination);
    }

    public function saveData(Request $request)
    {
        return parent::store($request->subject_info);
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
