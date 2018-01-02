<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChangeRequest extends Request
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
            'email'=>'required|required_with:ask_user,email|email',
            'password'=>'required|between:6,14|confirmed',
            'password_confirmation'=>'required|between:6,14',
        ];
    }
}
