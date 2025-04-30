<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|',
            'content' => 'required|string',
            'perex' => 'required|string',
            'main_image' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ];
    }
}
