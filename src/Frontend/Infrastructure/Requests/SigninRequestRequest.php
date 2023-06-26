<?php

namespace App\Src\Frontend\Infrastructure\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SigninRequestRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'signin_name'     => ['nullable', 'string'],
            'signin_email'    => ['required', 'email'],
            'signin_password' => ['required', 'string', 'min:6', 'max:12'],
            'signin_type'     => ['required', 'string']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
