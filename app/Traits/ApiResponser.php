<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{

    public function successResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json(['data' => $data], $code);
    }

    public function errrorResponse($message, $code)
    {
        return response()->json(['error' => $message,'site'=> 2, 'code' => $code], $code);
    }


}