<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContractRequest extends FormRequest
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
            "starting_date" => "nullable",
            "expiration_date" => "nullable",
            "template_name" => "required",
            "price_id" => "required|exists:prices,id",
            "service_id" => "required|exists:services,id",
            "word_link" => "nullable",
            "user_id" => "nullable",
            "signing_date" => "required",
            "note" => "nullable",
            "client_id" => "nullable",
            "pdf_link" => "nullable",
            "is_active" => "nullable",
            "is_visible_to_all" => "nullable"
        ];
    }

    public function messages()
    {
        return [
            "template_name.required" => "Naziv predloška je obavezan.",
        ];
    }
}
