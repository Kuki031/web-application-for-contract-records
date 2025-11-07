<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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

        $id = $this->route("service")?->id;
        return [
            "name" => "required|unique:services,name,{$id}",
            "description" => "required"
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Naziv usluge je obvezan.",
            "name.unique" => "Naziv usluge već postoji.",
            "description.required" => "Opis usluge je obavezan."
        ];
    }
}
