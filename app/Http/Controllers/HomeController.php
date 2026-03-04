<?php

namespace App\Http\Controllers;

use App\Models\Bread;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //show list of breads on home page
    public function index(Request $request)
    {
        $query = Bread::where('is_available', true);

        // Tìm kiếm theo tên và mô tả
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Lọc theo giá
        if ($request->has('price') && is_array($request->price)) {
            $priceRanges = $request->price;
            $query->where(function ($q) use ($priceRanges) {
                foreach ($priceRanges as $range) {
                    if ($range === '0-20000') {
                        $q->orWhereBetween('price', [0, 20000]);
                    } elseif ($range === '20000-30000') {
                        $q->orWhereBetween('price', [20000, 30000]);
                    } elseif ($range === '30000-50000') {
                        $q->orWhereBetween('price', [30000, 50000]);
                    } elseif ($range === '50000-60000') {
                        $q->orWhereBetween('price', [50000, 60000]);
                    } elseif ($range === '60000') {
                        $q->orWhere('price', '>=', 60000);
                    }
                }
            });
        }

        $breads = $query->orderBy('created_at', 'desc')->paginate(12)->withQueryString();

        return view('home', compact('breads'));
    }

    //show chi tiết bánh
    public function show($id)
    {
        $bread = Bread::findOrFail($id);
        return view('bread-detail', compact('bread'));
    }

    //show hot-selling products
    public function hotSelling(Request $request)
    {
        $breads = Bread::where('is_available', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('products.hot-selling', compact('breads'));
    }

    //show new products
    public function newProducts(Request $request)
    {
        $breads = Bread::where('is_available', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('products.new-products', compact('breads'));
    }

    //show sweet bread category
    public function sweetBread(Request $request)
    {
        $query = Bread::where('is_available', true)
            ->where('type', 'sweet');

        // Lọc theo giá
        if ($request->has('price') && is_array($request->price)) {
            $priceRanges = $request->price;
            $query->where(function ($q) use ($priceRanges) {
                foreach ($priceRanges as $range) {
                    if ($range === '0-50000') {
                        $q->orWhereBetween('price', [0, 50000]);
                    } elseif ($range === '50000-100000') {
                        $q->orWhereBetween('price', [50000, 100000]);
                    } elseif ($range === '100000-200000') {
                        $q->orWhereBetween('price', [100000, 200000]);
                    } elseif ($range === '200000') {
                        $q->orWhere('price', '>=', 200000);
                    }
                }
            });
        }

        $breads = $query->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('products.sweet-bread', compact('breads'));
    }

    //show salty bread category
    public function saltyBread(Request $request)
    {
        $query = Bread::where('is_available', true)
            ->where('type', 'salty');

        // Lọc theo giá
        if ($request->has('price') && is_array($request->price)) {
            $priceRanges = $request->price;
            $query->where(function ($q) use ($priceRanges) {
                foreach ($priceRanges as $range) {
                    if ($range === '0-50000') {
                        $q->orWhereBetween('price', [0, 50000]);
                    } elseif ($range === '50000-100000') {
                        $q->orWhereBetween('price', [50000, 100000]);
                    } elseif ($range === '100000-200000') {
                        $q->orWhereBetween('price', [100000, 200000]);
                    } elseif ($range === '200000') {
                        $q->orWhere('price', '>=', 200000);
                    }
                }
            });
        }

        $breads = $query->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('products.salty-bread', compact('breads'));
    }

    //show gallery
    public function gallery(Request $request)
    {
        $breads = Bread::where('is_available', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('gallery', compact('breads'));
    }
}
