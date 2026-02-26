<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bread;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BreadController extends Controller
{
    //List all breads
    public function index()
    {
        $breads = Bread::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.breads.index', compact('breads'));
    }

    //Show form to create new bread
    public function create()
    {
        return view('admin.breads.create');
    }

    //Save new bread
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:sweet,salty,other',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,jfif,webp|max:2048',
        ]);

        $data = $request->all();

        // Xử lý ảnh: ưu tiên upload file, sau đó mới đến chọn từ thư mục
        if ($request->hasFile('image')) {
            // Upload ảnh mới vào storage
            $data['image'] = $request->file('image')->store('breads', 'public');
        } elseif ($request->filled('image_from_folder')) {
            // Chọn ảnh từ thư mục public/images/breads
            $data['image'] = $request->image_from_folder;
        }

        Bread::create($data);

        return redirect()->route('admin.breads.index')->with('sucess', 'Thêm bánh mới thành công!');
    }

    //Show form to edit bread
    public function edit($id)
    {
        $bread = Bread::findOrFail($id);
        return view('admin.breads.edit', compact('bread'));
    }

    //Update bread
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:sweet,salty,other',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,jfif,webp|max:2048',
        ]);

        $bread = Bread::findOrFail($id);
        $data = $request->all();

        // Xử lý ảnh: ưu tiên upload file, sau đó mới đến chọn từ thư mục
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu là ảnh từ storage (không phải từ public/images)
            if ($bread->image && !str_starts_with($bread->image, 'images/')) {
                Storage::disk('public')->delete($bread->image);
            }
            // Upload ảnh mới vào storage
            $data['image'] = $request->file('image')->store('breads', 'public');
        } elseif ($request->filled('image_from_folder')) {
            // Xóa ảnh cũ nếu là ảnh từ storage (không phải từ public/images)
            if ($bread->image && !str_starts_with($bread->image, 'images/')) {
                Storage::disk('public')->delete($bread->image);
            }
            // Chọn ảnh từ thư mục public/images/breads
            $data['image'] = $request->image_from_folder;
        }

        $bread->update($data);

        return redirect()->route('admin.breads.index')->with('sucess', 'Cập nhật bánh thành công!');
    }

    //Delete bread
    public function destroy($id)
    {
        $bread = Bread::findOrFail($id);

        //Delete image
        if ($bread->image) {
            Storage::disk('public')->delete($bread->image);
        }

        $bread->delete();

        return redirect()->route('admin.breads.index')->with('sucess', 'Xóa bánh mì thành công!');
    }
}
