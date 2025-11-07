<?php

namespace App\Http\Requests;

use App\Rules\MultiEmail;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
        $id = $this->route("client")?->id;
        return [
            "name" => "sometimes",
            "address" => "sometimes",
            "oib" => "sometimes|min:11|max:13",
            "representer" => "sometimes",
            "connection_tag" => "sometimes|integer",
            "type_of_partner" => "sometimes",
            "phone" => "sometimes|unique:clients,phone,{$id}",
            "email" => ['sometimes', new MultiEmail()],
            "seller" => "sometimes",
            "activities" => "sometimes",
            "city" => "sometimes",
            "country" => "sometimes"
        ];
    }

    public function messages()
    {
        return [
            "connection_tag.integer" => "Vezna oznaka mora biti broj.",
            "phone.unique" => "Telefon već postoji.",
            "email.unique" => "E-mail adresa već postoji.",
            "oib.min" => "OIB mora imati minimalno 11 znakova.",
            "oib.max" => "OIB može imati maksimalno 13 znakova."
        ];
    }
}
