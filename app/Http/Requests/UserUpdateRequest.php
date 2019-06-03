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
            'name'       => 'max:30',
            'email'      => 'email|unique:users,email',
            'password'   => 'max:15|min:8'
        ];
    }

    public function messages()
    {
        return [
            'max'      => 'Maximum size exceeded for: :attribute ',
            'min'      => 'required minimum size for: :attribute ',
            'email'    => 'Email not allowed'
        ];
    }
}
