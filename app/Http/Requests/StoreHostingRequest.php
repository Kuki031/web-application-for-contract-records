<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHostingRequest extends FormRequest
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
            "client_id" => "required",
            "package_name" => "required",
            "package_description" => "required",
            "price" => "required",
            "expiration_date" => "nullable"
        ];
    }

    public function messages()
    {
        return [
            "client_id.required" => "Klijent je obavezan.",
            "price.required" => "Cijena je obavezna.",
            "package_name.required" => "Ime paketa je obavezno.",
            "package_description.required" => "Opis paketa je obavezan.",
        ];
    }
}
