<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;

use Illuminate\Http\Request;

class ClassScheduleController extends BaseController
{
    public $model_name = "App\Models\ClassSchedule";

    public function index($request)
    {
        return parent::index($request);
    }

    public function store(Request $request)
    {
        return parent::store($request);
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
