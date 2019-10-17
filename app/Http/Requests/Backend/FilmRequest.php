<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class FilmRequest extends FormRequest
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
            'name' => 'required',
            'year' => 'required|digits:4|integer|min:1990|max:'.(date('Y')+1),
            'price' => 'required|integer|min:10000',
            'author' => 'required|min:2',
            'actor' => 'required|min:2',
            'genre' => 'required',
            'time_limit' => 'required|integer|min:30',
            'kind' => 'required',
            'image' => 'image|nullable',
        ];
    }
}
