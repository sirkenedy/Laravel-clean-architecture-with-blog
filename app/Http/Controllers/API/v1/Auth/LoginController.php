<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Auth\LoginValidationRequest;
use Illuminate\Http\Request;

class LoginController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginValidationRequest $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $auth = Auth::user(); 
            $success['token'] =  $auth->createToken($request->email."-myAuth")->plainTextToken; 
            $success['name'] =  $auth->name;
   
            return $this->handleResponse($success, 'User logged-in!');
        } 
        else{ 
            return $this->handleError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
}
