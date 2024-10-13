<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
        $id = $this->route('student');
        return [
            'name'          => 'required',
            'email'         => ['required', Rule::unique('students')->ignore($id)],
            'classroom_id'  => 'required',
            'passport_number' => 'required|string|max:255',
            'subjects' => 'required|array',
            'subjects.*' => 'exists:subjects,id',
        ];
    }
}
