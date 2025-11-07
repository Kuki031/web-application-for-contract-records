<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNoteRequest extends FormRequest
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
            'note' => "required|string",
            'noteable_type' => ["required", Rule::in(['domain', 'hosting'])],
            'noteable_id' => "required|integer",
            'user_id' => "required|exists:users,id",
        ];
    }

    public function messages() {
        return [
            'note.required' => "Tekst napomene je obavezan.",
        ];
    }
}
