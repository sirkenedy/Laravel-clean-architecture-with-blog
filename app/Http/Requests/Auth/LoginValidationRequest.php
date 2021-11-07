<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "email" => "bail|required|string|email|exists:users",
            "password" => "required|string",
        ];
    }

    public function messages()
    {
        return [
            "email.required" => "Email field cannot be empty. Enter your login credentials",
            "email.email" => "Enter a valid email address",
            "email.exists" => "User with this credential does not exist",
            "password.required" => 'Password field cannot be empty',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            //
        ]);
    }
}
