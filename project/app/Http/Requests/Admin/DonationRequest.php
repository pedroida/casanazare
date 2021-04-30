<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DonationRequest extends FormRequest
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
            'name' => 'max:255|required|unique:donations,name',
            'quantity' => 'required|min:0',
            'validate' => 'nullable|date_format:d/m/Y',
            'donation_unit_id' => 'required|exists:donation_units,id',
            'donation_category_id' => 'required|exists:donation_categories,id'
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['name'] .= ",{$this->donation}";
        }

        return $rules;
    }
}
