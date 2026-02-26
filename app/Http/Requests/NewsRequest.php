<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class NewsRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    public function rules()
    {
        $newsId = $this->route('news') ? $this->route('news') : null;

        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:news,slug' . ($newsId ? ',' . $newsId : ''),
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ];
    }
}
