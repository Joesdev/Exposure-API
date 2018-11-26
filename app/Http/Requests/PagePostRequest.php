<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagePostRequest extends FormRequest
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
            'description'  => 'required|string|max:150',
            'fear_before'  => 'integer|between:1,10',
            'fear_during'  => 'integer|between:1,10',
            'satisfaction' => 'integer|between:1,10'
        ];
    }
}
