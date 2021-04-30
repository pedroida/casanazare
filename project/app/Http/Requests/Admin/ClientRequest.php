<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name' => 'required|max:255',
            'rg' => 'required|size:12',
            'date_of_birth' => 'required|date_format:"d/m/Y"|before:today',
            'phone_one' => 'required|min:14',
            'phone_two' => 'required|min:14',
            'city_id' => 'required|exists:cities,id',
        ];
    }
}
