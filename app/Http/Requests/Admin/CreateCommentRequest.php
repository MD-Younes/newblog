<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image',
            'tags' => 'required|string',
            'category' => 'required|integer|exists:categories,id',
            'user_id' => 'required|integer|exists:users,id', // أضف هذا السطر
            'comment' => 'required|string',
        ];
    }
}
