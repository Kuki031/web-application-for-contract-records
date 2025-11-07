<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTemplateRequest extends FormRequest
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
        $id = $this->route('template')?->id;
        return [
            'name' => "required|unique:templates,name,{$id}",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Naziv predloška je obavezan.",
            "name.unique" => "Naziv predloška već postoji."
        ];
    }
}
