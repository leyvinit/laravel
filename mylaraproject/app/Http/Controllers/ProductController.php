<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Search (by name or description)
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter: category
        if ($cat = $request->input('category')) {
            $query->where('category', $cat);
        }

        // Filter: price range
        if ($min = $request->input('min_price')) {
            $query->where('price', '>=', (float) $min);
        }
        if ($max = $request->input('max_price')) {
            $query->where('price', '<=', (float) $max);
        }

        // Sort
        switch ($request->input('sort')) {
            case 'name_asc':   $query->orderBy('name', 'asc'); break;
            case 'name_desc':  $query->orderBy('name', 'desc'); break;
            case 'price_asc':  $query->orderBy('price', 'asc'); break;
            case 'price_desc': $query->orderBy('price', 'desc'); break;
            case 'oldest':     $query->orderBy('created_at', 'asc'); break;
            default:           $query->orderBy('created_at', 'desc'); // newest
        }

        $products   = $query->paginate(12)->appends($request->query());
        $categories = Product::select('category')->distinct()->orderBy('category')->pluck('category');

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image_url'   => 'nullable|url|max:2048',
            'description' => 'nullable|string',
        ]);

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image_url'   => 'nullable|url|max:2048',
            'description' => 'nullable|string',
        ]);

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted!');
    }
}
