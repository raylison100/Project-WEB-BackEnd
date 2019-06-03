<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
           'name'       => 'required|max:30',
           'email'      => 'required|email|unique:users,email',
           'password'   => 'required|max:15|min:8'
        ];
    }

    public function messages()
    {
        return [
                'required' => 'The field: :attribute is required!',
            'max'      => 'Maximum size exceeded for: :attribute ',
            'min'      => 'required minimum size for: :attribute ',
            'email'    => 'Email not allowed'
        ];
    }
}
