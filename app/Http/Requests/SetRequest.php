<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SetRequest extends Request
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
            'username' => 'sometimes|between:3,10|alpha_dash|unique:ask_user,username',
            'nickname' => 'sometimes|between:3,10|unique:ask_user,nickname',
            'email' => 'sometimes|email|unique:ask_user,email',
            'password' => 'sometimes|confirmed|between:6,14',
            'phone' => 'sometimes|integer|unique:ask_user,phone',
        ];
    }
}
