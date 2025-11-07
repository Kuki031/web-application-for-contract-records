<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminUserRequest extends FormRequest
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
        $userId = $this->route("user")?->id;
        return [
            "username" => "nullable|unique:users,username,{$userId}",
            "password" => "nullable|min:8",
            "password_same" => "nullable|same:password"
        ];
    }

    public function messages()
    {
        return [
            "username.unique" => "Korisničko ime već postoji.",
            "password.min" => "Minimalna dužina lozinke je 8 znakova.",
            "password_same.same" => "Lozinke se ne podudaraju."
        ];
    }
}
