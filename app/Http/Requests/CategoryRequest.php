<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $locales = Language::active()->get()->pluck('code')->toArray(); // ['en']
        $data = [];

        $imageValidation = 'required';
        if (request()->method() == 'PUT') {
            $imageValidation = 'nullable';
        }

        foreach ($locales as $locale) {
            $data['name_' . $locale] = 'required'; // name_en
        }

        $data['image'] = $imageValidation;
        // dd($data);
        return $data;
    }
}
