<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'assunto'           => 'required|string|max: 100',
            'user_id'           => 'required|integer',
            'status_ticket_id'  => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório!',
            'max'      => 'tamanho maximo ultrapassado :attribute ',
            'min'      => 'tamanho minino nao digitado :attribute '
        ];
    }
}
