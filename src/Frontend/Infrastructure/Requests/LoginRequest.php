<?php

namespace App\Src\Frontend\Infrastructure\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'       => ['required', 'email'],
            'password'    => ['required', 'string', 'min:6', 'max:12'],
            'select_type' => ['required', 'string']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
