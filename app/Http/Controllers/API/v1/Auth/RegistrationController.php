<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Auth\RegistrationValidationRequest;
use Illuminate\Http\Request;
use App\Models\User;

class RegistrationController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegistrationValidationRequest $request)
    {
        $input = $request->validated();
        $user = User::create($input);
        $success['token'] =  $user->createToken($request->email."-myAuth")->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->handleResponse($success, 'User successfully registered!');
    }
}
