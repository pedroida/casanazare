<?php

namespace App\Http\Requests\Admin;

use App\Enums\StayTypeEnum;
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
        $types = [StayTypeEnum::PATIENT, StayTypeEnum::COMPANION];

        $rules = [
            'type' => 'required|in:' . implode(',', $types),
            'client_id' => 'required|exists:clients,id',
            'source_id' => 'required|exists:sources,id',
            'responsible_id' => 'required|exists:users,id',
            'entry_date' => 'required|date_format:d/m/Y',
            'departure_date' => 'nullable|date_format:d/m/Y',
            'comments' => 'nullable|string',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['client_id'] .= ",{$this->estadia}";
        }

        return $rules;
    }
}
