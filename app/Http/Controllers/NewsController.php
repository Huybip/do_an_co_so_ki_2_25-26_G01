<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::published()->orderBy('published_at', 'desc')->paginate(9);
        return view('news.index', compact('news'));
    }

    public function show($slug)
    {
        $item = News::where('slug', $slug)->published()->firstOrFail();
        return view('news.show', compact('item'));
    }
}
