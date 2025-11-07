<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractRequest extends FormRequest
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
            "starting_date" => "required",
            "expiration_date" => "nullable",
            "template_name" => "required",
            "price_id" => "required",
            "service_id" => "required",
            "word_link" => "nullable",
            "user_id" => "required",
            "signing_date" => "required",
            "note" => "nullable",
            "client_id" => "required",
            "pdf_link" => "nullable",
            "is_active" => "nullable",
            "is_visible_to_all" => "nullable"
        ];
    }

    public function messages()
    {
        return [
            "starting_date.required" => "Datum početka usluge je obavezno polje.",
            "expiration_date.required" => "Datum isteka usluge je obavezno polje.",
            "expiration_date.after" => "Datum isteka usluge ne može biti prije datuma početka usluge.",
            "template_name.required" => "Obvezno je odabrati predložak za ugovor.",
            "price_id.required" => "Obvezno je odabrati cijenu.",
            "service_id.required" => "Obvezno je odabrati uslugu.",
            "signing_date.required" => "Datum potpisa ugovora je obavezan.",
            "client_id.required" => "Obvezno je odabrati klijenta"
        ];
    }
}
