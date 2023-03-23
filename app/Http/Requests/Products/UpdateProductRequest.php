<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:255',
            ],
            'category_id' => [
                'exists:categories,id',
            ],
            'price' => [
                'string',
            ],
            'brand' => [
                'string',
                'max:255',
            ]
        ];
    }
}
