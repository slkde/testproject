<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AnswerRequest extends Request
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
            'answer_content' => 'required',
            'question_id' => 'required|required_with:ask_question,id'
        ];
    }
}
