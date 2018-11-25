<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActionUpdateRequest extends FormRequest
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
            'description'  => 'required_without:fear_average|min:5|max:60',
            'fear_average' => 'numeric'
        ];
    }

    public function messages()
    {
        return [
            'required_without' => 'The :attribute field is required'
        ];
    }
}
