<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        // dd($this->admin->id);
        $emailValidation = 'email|required|unique:admins,email';
        if (request()->method() == 'PUT') {
            $emailValidation = 'email|required|unique:admins,email,' . $this->admin->id . ',id';
        }
        return [
            'name' => 'required',
            // 'mobile' => 'required',
            'email' => $emailValidation,
            'password' => 'min:6|confirmed',
        ];
    }
}
