<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProgramRequest extends FormRequest
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

        $programId = $this->route('program');

        return [
            'edit_program_Title' => 'required|max:255',
            'edit_program_Code' => [
                'required',
                'max:10',
                Rule::unique('programs', 'program_Code')->ignore($programId, 'program_id'),
            ],
        ];
    }

    public function attributes()
    {
        return [
            'edit_program_Title' => 'Program Title',
            'edit_program_Code' => 'Program Code',
        ];
    }
}
