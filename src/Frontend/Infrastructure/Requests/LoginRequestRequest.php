<?php

namespace App\Src\Frontend\Infrastructure\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequestRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login_email'    => ['required', 'email'],
            'login_password' => ['required', 'string', 'min:6', 'max:12'],
            'login_type'     => ['required', 'string']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
