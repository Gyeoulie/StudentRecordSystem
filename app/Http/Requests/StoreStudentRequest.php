<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            //
            'first_name' => 'required|max:255',
            'middle_name' => 'nullable|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|unique:students,student_Email|email',
            'student_number' => 'required|unique:students,student_Number|max:11|regex:/^\d{4}-\d{6}$/',
            'birthdate' => 'required|date|before_or_equal:today',
            'gender' => 'required|in:1,2',
            'program' => 'required|exists:programs,program_id',
            'year_level' => 'required|integer|between:1,6',
            'student_status' => 'required|integer|between:1,3',
            'notes' => 'nullable|max:1500 ',
            'student_image' => 'nullable|image|mimes:jpg,jpeg,png|max:5096',

        ];
    }

    public function attributes()
    {
        return [
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'email' => 'Email Address',
            'student_number' => 'Student ID Number',
            'birthdate' => 'Date of Birth',
            'gender' => 'Gender',
            'program' => 'Program/Course',
            'year_level' => 'Year Level',
            'student_status' => 'Student Status',
            'notes' => 'Notes',
            'student_image' => 'Student Image',
        ];
    }
}
