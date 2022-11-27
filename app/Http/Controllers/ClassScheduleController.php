<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Http\Resources\ClassScheduleResource;
use Illuminate\Http\Request;

class ClassScheduleController extends BaseController
{
    public $model_name = "App\Models\ClassSchedule";
    public $classScheduleResource;

    public function __construct()
    {
        $this->classScheduleResource = new ClassScheduleResource(array());
    }

    public function index($request)
    {
        return parent::index($request);
    }

    public function saveData(Request $request)
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
