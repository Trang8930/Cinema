<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ImportFileRequest extends FormRequest
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
            "import_data" => 'required'
        ];
    }

    /**
     * Set validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'import-data.mimes' => __('Please import file excel or .csv'),
        ];
    }

}
