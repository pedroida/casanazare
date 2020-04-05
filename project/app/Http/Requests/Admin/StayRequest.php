<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StayRequest extends FormRequest
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
            'name' => 'max:255|required|unique:sources,name',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['name'] .= ",{$this->source}";
        }

        return $rules;
    }
}
