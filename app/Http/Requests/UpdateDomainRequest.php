<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDomainRequest extends FormRequest
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
            "name" => "required",
            "type" => "required",
            "registrar" => "required",
            "user" => "required",
            "has_access" => "nullable",
            "is_redirected" => "required",
            "is_redirected_where" => "required_if:is_redirected,1",
            "expires_at" => "nullable",
            "client_id" => "required"
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Ime domene je obavezno.",
            "type.required" => "Vrsta domene je obavezna.",
            "registrar.required" => "Registrar je obavezan.",
            "user.required" => "Korisnik domene je obavezan.",
            "is_redirected.required" => "Je li domena preusmjerena je obavezno.",
            "is_redirected_where.required_if" => "Ako je domena preusmjerena, potrebno je unjeti gdje je preusmjerena.",
            "client_id.required" => "Klijent je obavezan."
        ];
    }
}
