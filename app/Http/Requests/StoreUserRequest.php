<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        return [
            "username" => "required|unique:users,username",
            "password" => "required|min:8",
            "password_same" => "required|same:password"
        ];
    }

    public function messages()
    {
        return [
            "username.required" => "Korisničko ime je obavezno.",
            "password.required" => "Lozinka je obavezna.",
            "password.min" => "Lozinka mora imati najmanje 8 znakova.",
            "password_same.required" => "Ponoviti lozinku je obavezno.",
            "password_same.same" => "Lozinke se ne podudaraju."
        ];
    }
}
