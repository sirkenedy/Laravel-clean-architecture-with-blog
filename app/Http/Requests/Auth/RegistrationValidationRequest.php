<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationValidationRequest extends FormRequest
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
            "email" => "bail|required|string|email|unique:users",
            "name" => "required|string",
            "username" => "required|string",
            "password" => "required|string",
        ];
    }

    public function messages()
    {
        return [
            "email.required" => "Email field cannot be empty. Enter your login credentials",
            "email.email" => "Enter a valid email address",
            "email.unique" => "User with this email address already exist",
            "password.required" => "Password field cannot be empty",
            "name.required" => "Name field cannot be empty",
            "username.required" => "Username field cannot be empty",
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            //
        ]);
    }
}
