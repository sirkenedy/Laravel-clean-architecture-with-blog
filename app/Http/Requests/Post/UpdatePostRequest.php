<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('sanctum')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "bail|required|string",
            "description" => "required|string",
            "keywords" => "required|string", //using array instead of string will be a great one. futute update
            "image" => "nullable|file|max:1024|mimes:jpg,jpeg,bmp,png",
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "Post title field cannot be empty.",
            "description.required" => 'Enter post content',
            "keywords.required" => 'Enter post keywords',
            "image.required" => 'Enter post header image',
            "image.file" => 'Invalid format supplied for post image',
            "image.mimes" => 'Invalid image format uploaded. the supported format are jpg, png, bmp and jpeg',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            "user_id" => auth('sanctum')->user()->id,
        ]);
    }
}
