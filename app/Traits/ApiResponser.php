<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponser
{
	protected function successResponse($data, $message,$code=Response::HTTP_OK)
	{
		return response()->json(
			['data' => $data, 'message' => $message,'status_code'=>$code]
			, $code);
	}

	protected function errorResponse(string $message,int $code=Response::HTTP_INTERNAL_SERVER_ERROR)
	{
		return response()->json(['error' => $message,'status_code'=>$code], $code);
	}

	protected function showAll(Collection $collection,int $code=Response::HTTP_OK)
	{
		if ($collection->isEmpty()) {
			return $this->successResponse(['data' => $collection,'message'=>'no record found'], $code);
		}	

		return $this->successResponse($collection,'fetch all record successfully',$code);
	}

	protected function showOne(Model $instance,int $code=Response::HTTP_OK)
	{
		return $this->successResponse($instance,'fetch record successfully',$code);
	}
	protected function successMessage(string $message,int $code=Response::HTTP_OK)
	{
		return response()->json(['message' => $message],$code);
	}

}