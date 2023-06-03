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
                    'option_a' => request()->route('uuid') 
                    ? 'required|:tp_question,option_a,'.request()->route('uuid').',uuid_question'
                    : 'required:tp_question',
                    'option_b' => request()->route('uuid') 
                    ? 'required:tp_question,option_b,'.request()->route('uuid').',uuid_question'
                    : 'required:tp_question',
                    'option_c' => request()->route('uuid') 
                    ? 'required:tp_question,option_c,'.request()->route('uuid').',uuid_question'
                    : 'required:tp_question',
                    'option_d' => request()->route('uuid') 
                    ? 'required:tp_question,option_d,'.request()->route('uuid').',uuid_question'
                    : 'required:tp_question',
        ];
    }

    public function messages()
    {
        return [
            'quiz.required' => 'Vui lòng nhập câu hỏi',
            'quiz.unique' => 'Câu hỏi này đã tồn tại',
            'option_a.required' => 'Vui lòng nhập đáp án A',
            'option_b.required' => 'Vui lòng nhập đáp án B',
            'option_c.required' => 'Vui lòng nhập đáp án C',
            'option_d.required' => 'Vui lòng nhập đáp án D',
        ];
    }
}
