<?php

namespace App\Http\Requests;

use App\Http\Traits\GeneralTrait;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreTodoRequest extends FormRequest
{
    use GeneralTrait;
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
            'title' => 'required|string|max:255',
            'description' => 'string',
            'completed' => 'boolean',
            'attachments' => 'array',
            'attachments.*' => [File::types(['pdf'])->max((5*1024))],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'completed' => filter_var($this->completed, FILTER_VALIDATE_BOOLEAN),
        ]);
    }

}
