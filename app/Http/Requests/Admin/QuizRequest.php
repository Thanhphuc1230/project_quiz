<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'quiz' => request()->route('uuid') 
                    ? 'required|unique:tp_question,quiz,'.request()->route('uuid').',uuid_question'
                    : 'required|unique:tp_question',
            'option' => request()->route('uuid') 
            ? 'required'
            : 'required',
                  
        ];
    }

    public function messages()
    {
        return [
            'quiz.required' => 'Vui lòng nhập câu hỏi',
            'quiz.unique' => 'Câu hỏi này đã tồn tại',
            'option.required' => 'Vui lòng nhập đáp án ',
         
        ];
    }
}
