<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $emailValidation = 'email|required|unique:users,email';
        if (request()->method() == 'PUT') {
            $emailValidation = 'email|required|unique:users,email,' . $this->user->id . ',id';
        }
        return [
            'name' => 'required',
            'mobile' => 'required',
            'email' => $emailValidation,
            'password' => 'min:6|confirmed',
        ];
    }
}
