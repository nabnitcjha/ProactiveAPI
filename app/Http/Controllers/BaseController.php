<?php

namespace App\Http\Controllers;
class BaseController extends Controller
{
    //
    public function getError($message)
    {
        $this->errorResponse($message);
    }

    public function getModel()
    {
        // $this->Query = $this->Model::select("*");
        return $this->Model;
    }

    public function createModelObject($model)
    {
        $this->Model = new $model;
    }

    public function index($allowPagination)
    {
        // home?category=Cars&make=Tesla
        // request('category')
        $data = '';
        if (str_contains($allowPagination, 'true')) {
            $data = $this->Model::paginate(5);
        } else {
            $data = $this->Model::get();
        }
        return $this->successResponse($data, 'fetch record successfully');
        // return  $this->showAll($data);
    }

    public function store($request)
    {
        // $params["deleted_at"] = date('Y-m-d H:i:s');
        // $request->request->add(['params' => $params]); 

        $params = $request;

        $Model = $this->getModel();
        foreach ($params as $key => $value) {
            $Model->$key = $value;
        }
        if (!$Model->save()) {
            return $this->getError("faild to save");
        }

        return $Model;
    }

    public function show($id)
    {
        $Model = $this->getModel();
        $Obj = $Model::find($id);
        if (!$Obj) {
            return $this->getError("Can not find {$id}");
        }

        $this->successResponse($Obj, 'fetch record successfully');
    }

    public function update($request, $id)
    {
        $params = $request;

        $Model = $this->getModel();
        $Model = $Model::find($id);
        if (!$Model) {
            return $this->getError("Can not find {$id}");
        }
        foreach ($params as $key => $value) {
            $Model->$key = $value;
        }
        if (!$Model->save()) {
            return $this->getError("Faild update {$id}");
        }

        $this->successResponse($Model, 'update successfully');
    }

    public function destroy($id)
    {
        $Model = $this->getModel();
        $Obj = $Model::find($id);
        if (!$Obj) {
            return $this->getError("Can not find {$id}");
        }
        if (!$Obj->delete()) {
            return $this->getError("Faild delete {$id}");
        }

        $this->successResponse($Obj, 'delete successfully');
    }
}
