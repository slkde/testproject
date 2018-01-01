<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use App\Model\User;

class MessageRequest extends Request
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
            'user_name' => 'required|exists:ask_user,nickname',
            'message_title' => 'required|between:3,20|string',
            'message_body' => 'required|between:6,100|string'
        ];
    }
}
