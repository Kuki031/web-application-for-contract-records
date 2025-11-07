<?php

namespace App\Http\Requests;

use App\Rules\MultiEmail;
use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            "name" => "required|unique:clients,name",
            "address" => "required",
            "oib" => "required|min:11|max:13",
            "representer" => "required",
            "connection_tag" => "required|integer",
            "type_of_partner" => "nullable",
            "phone" => "nullable|unique:clients,phone",
            "email" => ['required', new MultiEmail()],
            "seller" => "nullable",
            "activities" => "nullable",
            "city" => "required",
            "country" => "required"
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Ime klijenta je obvezno.",
            "name.unique" => "Klijent već postoji.",
            "oib.required" => "OIB je obavezan.",
            "oib.min" => "OIB mora imati minimalno 11 znakova.",
            "oib.max" => "OIB može imati maksimalno 13 znakova.",
            "representer.required" => "Predstavnik je obavezan.",
            "email.required" => "E-mail adresa je obavezna.",
            "connection_tag.integer" => "Vezna oznaka mora biti broj.",
            "connection_tag.required" => "Vezna oznaka je obavezna.",
            "phone.unique" => "Telefon već postoji.",
            "email.unique" => "E-mail adresa već postoji.",
            "city.required" => "Grad je obavezan.",
            "country.required" => "Država je obavezna.",
            "address.required" => "Adresa je obavezna."
        ];
    }
}
