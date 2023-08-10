<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCvRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'date',
            'universities_id' => 'required',
            'technologies_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'university_id.exists' => 'The selected university is not valid.',
            'technologies.required' => 'At least one technology is required.',
            'technologies.array' => 'Technologies must be an array.',
            'technologies.*.exists' => 'Invalid technology selected.',
        ];
    }
}
