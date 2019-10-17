<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'fullname' => 'required|min:3',
            'email' => 'required|min:3|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|max:18',
            'password_confirmation' => 'required|max:18',
            'birthday' => 'required|date',
            'image' => 'image|nullable'
        ];
    }
}
