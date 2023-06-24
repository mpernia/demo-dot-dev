<?php

namespace App\Src\Shared\Infrastructure\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer'],
            'username' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min' => 8, 'max' => 12],
        ];
    }
}
