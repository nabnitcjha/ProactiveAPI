<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public $model_name = "App\Models\Student";
    public function index($allowPagination)
    {
        return parent::index($allowPagination);
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
