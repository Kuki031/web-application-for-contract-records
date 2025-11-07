<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            "password" => "required",
            "password_new" => "required|min:8",
            "password_confirm" => "required|same:password_new"
        ];
    }

    public function messages()
    {
        return [
            "password.required" => "Stara lozinka je obavezna.",
            "password_new.required" => "Nova lozinka je obavezna.",
            "password_new.min" => "Nova lozinka mora imati minimalno 8 znakova.",
            "password_confirm.required" => "Potrebno je ponoviti novu lozinku.",
            "password_confirm.same" => "Lozinke se ne podudaraju"
        ];
    }
}
