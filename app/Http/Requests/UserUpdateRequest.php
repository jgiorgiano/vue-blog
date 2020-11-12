<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|min: 5',
            'subscribe' => 'nullable|boolean',
            'profile_image' => 'nullable'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'subscribe' => $this->input('subscribe') == 'false' ? 0 : 1,
            'profile_image' => $this->input('profile_image') == 'null' ? null : $this->input('profile_image'),
        ]);
    }
}
