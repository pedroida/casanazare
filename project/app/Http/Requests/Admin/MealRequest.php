<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MealRequest extends FormRequest
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
        $rules = [
            'breakfasts' => 'required|numeric|min:0',
            'lunches' => 'required|numeric|min:0',
            'dinners' => 'required|numeric|min:0',
            'day' => 'required'
        ];

        if ($this->method() == 'POST') {
            $rules['day'] .= "|date|unique:meals";
        }

        return $rules;
    }
}
