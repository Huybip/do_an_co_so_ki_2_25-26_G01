<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Requests\NewsRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(NewsRequest $request)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']) . '-' . Str::random(5);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/news', 'public');
            $data['image'] = $path;
        } elseif ($request->filled('image_from_folder')) {
            $data['image'] = $request->input('image_from_folder');
        }

        $data['is_published'] = (bool) ($request->filled('is_published') && $request->input('is_published'));

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Tin tức đã được tạo.');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function show(News $news)
    {
        // Redirect to public view for preview
        return redirect()->route('news.show', $news->slug);
    }

    public function update(NewsRequest $request, News $news)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']) . '-' . Str::random(5);
        }

        if ($request->hasFile('image')) {
            // delete old
            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }
            $path = $request->file('image')->store('images/news', 'public');
            $data['image'] = $path;
        } elseif ($request->filled('image_from_folder')) {
            $data['image'] = $request->input('image_from_folder');
        }

        $data['is_published'] = (bool) ($request->filled('is_published') && $request->input('is_published'));

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Tin tức đã được cập nhật.');
    }

    public function destroy(News $news)
    {
        if ($news->image && Storage::disk('public')->exists($news->image)) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Tin tức đã được xóa.');
    }
}
