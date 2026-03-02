<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class NewsRequest extends FormRequest
{
    public function authorize()
    {
        // Check if user is authenticated and is admin
        if (!Auth::check()) {
            return false;
        }

        $user = Auth::user();
        return method_exists($user, 'isAdmin') ? $user->isAdmin() : ($user->role === 'admin');
    }

    public function rules()
    {
        // Get the News id from route - handle both string ID and Model object
        $newsId = null;
        $newsParam = $this->route('news');
        if ($newsParam) {
            $newsId = is_object($newsParam) ? $newsParam->id : $newsParam;
        }

        return [
            'title' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('news', 'slug')->ignore($newsId),
            ],
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ];
    }
}
