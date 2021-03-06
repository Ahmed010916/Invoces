<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
            'section_name'=> 'required|string|min:1|unique:sections,section_name|max:50',
            'note'        => 'nullable|string|max:200'
        ];
    }

    public function messages()
    {
        return [
           // 'section_name.required'=> 'Ahmed',//test
        ];
    }
}
