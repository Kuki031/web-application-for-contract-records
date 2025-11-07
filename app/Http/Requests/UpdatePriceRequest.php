<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePriceRequest extends FormRequest
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
            "price" => "required|regex:/^\d+(\.\d{1,4})?$/",
            "price_words" => "required",
            "currency" => "required"
        ];
    }

    public function messages()
    {
        return [
            "price.required" => "Cijena je obavezna.",
            "price.regex" => "Unositi '.' umjesto ','.",
            "price_words.required" => "Cijena (riječima) je obavezno.",
            "currency.required" => "Valuta je obavezna."
        ];
    }
}
