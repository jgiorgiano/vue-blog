<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => 'required|min: 10|max:150',
            "description" => 'required|max:200',
            "type" => 'required|integer',
            "external_link" => 'required_if:type,2|max:255',
            "content" => 'required_if:type,1',
            "tags" => 'required|min: 3|max: 100'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'content.required_if' => 'The Content field is required.',
            'external_link.required_if' => 'The External Link field is required.',
        ];
    }
}
