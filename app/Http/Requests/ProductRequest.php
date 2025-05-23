<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $imageValidation = 'required';
        if (request()->method() == 'PUT') {
            $imageValidation = 'nullable';
        }

        $validation = [
            'category_id' => 'required',
            'image' => $imageValidation,
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
        ];

        $locales = Language::active()->pluck('code')->toArray();
        foreach ($locales as  $locale) {
            $validation['name_' . $locale] = 'required';
            $validation['description_' . $locale] = 'required';
        }
        return $validation;
    }

    public function attributes()
    {
        return [
            'category_id' => 'Category'
        ];
    }
    public function messages()
    {
        return [
            'category_id.required' => 'The Select Category is required.'
        ];
    }
}
