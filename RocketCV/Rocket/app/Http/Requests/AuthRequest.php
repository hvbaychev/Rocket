<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->is('login-user')) {
            return [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ];
        } else {
            return [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/',
                'password_confirmation' => 'required_with:password|same:password|min:6',
            ];
        }
    }
}
