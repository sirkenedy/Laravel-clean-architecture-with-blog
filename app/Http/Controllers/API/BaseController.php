<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function handleResponse($result, $msg, $status=200)
    {
    	$res = [
            'success' => true,
            'data'    => $result,
        ];
        if(!empty($msg)){
            $res['message'] = $msg;
        }
        return response()->json($res, $status);
    }

    public function handleError($error, $errorMsg = [], $code = 404)
    {
    	$res = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMsg)){
            $res['data'] = $errorMsg;
        }
        return response()->json($res, $code);
    }
}
