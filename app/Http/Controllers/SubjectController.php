<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends BaseController
{
    public $Model;
    private $subjectResource;

    public function __construct()
    {
        $this->subjectResource = new SubjectResource(array());
        $this->Model = new Subject();
    }

    public function index($allowPagination)
    {
        return parent::index($allowPagination);
    }

    public function saveData(Request $request)
    {
        $subject = parent::store($request->subject_info);
        $this->successResponse($subject, 'save successfully');
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
