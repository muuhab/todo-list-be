<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTodoRequest extends FormRequest
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
        $method = $this->method();
        if ($method === 'PUT') {
            return [
                'title' => 'required|string|max:255',
                'description' => 'string',
                'completed' => 'boolean',
            ];
        }
        else {
            return [
                'title' => 'sometimes|required|string|max:255',
                'description' => 'sometimes|string',
                'completed' => 'sometimes|boolean',
            ];
        }

    }

    protected function prepareForValidation()
    {
        $this->merge([
            'completed' => filter_var($this->completed, FILTER_VALIDATE_BOOLEAN),
        ]);
    }

}
