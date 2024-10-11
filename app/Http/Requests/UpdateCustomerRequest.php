<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UpdateCustomerRequest extends FormRequest
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

        $id = $this->route('customer');
        return [
            [
                'name'          => 'required|max:255',
                'address'       => 'required|max:255',
                'avatar'        => 'nullable|image|max:2048',
                'phone'         => ['required', 'string', 'max:20', Rule::unique('customers')->ignore($id)],
                'email'         => 'required|email|max:100',
                'is_active'     => ['nullable', Rule::in([0, 1])],
            ]
        ];
    }

    public function messages()
{
    return [
        'name.required'     => 'Trường :attribute là bắt buộc.',
        'name.max'          => ':attribute không được vượt quá 255 ký tự.',
        'address.required'  => 'Trường :attribute là bắt buộc.',
        'address.max'       => ':attribute không được vượt quá 255 ký tự.',
        'avatar.image'      => ':attribute phải là một hình ảnh.',
        'avatar.max'        => ':attribute không được vượt quá 2MB.',
        'phone.required'    => 'Trường :attribute là bắt buộc.',
        'phone.string'      => ':attribute phải là chuỗi ký tự.',
        'phone.max'         => ':attribute không được vượt quá 20 ký tự.',
        'phone.unique'      => ':attribute này đã tồn tại.',
        'email.required'    => 'Trường :attribute là bắt buộc.',
        'email.email'       => ':attribute không hợp lệ.',
        'email.max'         => ':attribute không được vượt quá 100 ký tự.',
        'is_active.in'      => 'Trạng thái :attribute không hợp lệ.',
    ];
}

public function attributes()
{
    return [
        'name'      => 'tên',
        'address'   => 'địa chỉ',
        'avatar'    => 'hình đại diện',
        'phone'     => 'số điện thoại',
        'email'     => 'email',
        'is_active' => 'trạng thái kích hoạt',
    ];
}

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(response()->json(
            [
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $errors,
            ],
            422
        ));
    }
}
