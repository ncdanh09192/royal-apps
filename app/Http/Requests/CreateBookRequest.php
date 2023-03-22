<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'author_id' => 'required|integer',
            'title' => 'required|string',
            'release_date' => 'required|string',
            'description' => 'required|string',
            'isbn' => 'required|string',
            'format' => 'required|string',
            'number_of_pages' => 'required|integer',
        ];
    }
}
