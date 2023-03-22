<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsersRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'max:255',
            ],
            'username' => [
                'string',
                'unique:users',
            ],
            'email' => [
                'email',
                'unique:users',
                'string',
            ],
            'password' => [
                'string',
                'max:255',
                'min:6',
            ]
        ];
    }
}
