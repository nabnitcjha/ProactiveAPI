<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    //
    public $model_name;
    public $resource_name;
    public $Model;
    
    public function __construct() {
        if (!class_exists($this->model_name)) {
            throw new \Exception('An unexpected error occurred. Please contact customer support.');
        }
        $this->Model = new $this->model_name;
        // $this->resource = new $this->resource_name;
        $this->Query = $this->Model::select("*");
    }
    
    public function getError($message) {
        $this->errorResponse($message);
    }
    
    public function getModel() {
        return $this->Model;
    }
    
    public function index($allowPagination)
    {
        // home?category=Cars&make=Tesla
        // request('category')
        if(str_contains($allowPagination, 'true')){
            $data = $this->Query->paginate(5); 
        }
        else{
            $data = $this->Query->get();
        }
        
        $this->showAll($data);
    }
    
    public function create()
    {
        //
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
        if (!$Obj) { return $this->getError("Can not find {$id}"); }
        
        $this->successResponse($Obj,'fetch record successfully');
    }
    
    public function update(Request $request, $id)
    {
        $params = $request->input();
        
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
         
        $this->successResponse($Model,'update successfully');
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
       
        $this->successResponse($Obj,'delete successfully');
	}
}
