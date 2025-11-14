<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgramRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'program_Title' => 'required|max:255',
            'program_Code' => 'required|unique:programs|max:10',
        ];
    }

    public function attributes()
    {
        return [
            'program_Title' => 'Program Title',
            'program_Code' => 'Program Code',
        ];
    }
}
