<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bundle;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BundleController extends Controller
{
    public function index(Request $request)
    {
        $query = Bundle::with(['products.variants']);

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $query->oldest();
                    break;
                case 'title_asc':
                    $query->orderBy('title', 'asc');
                    break;
                case 'title_desc':
                    $query->orderBy('title', 'desc');
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $bundles = $query->paginate(10);

        if ($request->ajax()) {
            return view('admin.bundles.partials.table', compact('bundles'))->render();
        }

        return view('admin.bundles.index', compact('bundles'));
    }

    public function create()
    {
        $products = Product::where('status', 'active')->get();
        return view('admin.bundles.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'products' => 'required|array|min:1',
            'products.*' => 'exists:products,id',
            'image' => 'nullable|image|mimes:webp',
        ]);

        $slug = Str::slug($request->title);
        // Ensure unique slug
        $count = Bundle::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('bundles', 'public');
        }

        $bundle = Bundle::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->status ?? 'draft',
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
        ]);

        $bundle->products()->attach($request->products);

        return redirect()->route('admin.bundles')->with('success', 'Bundle created successfully.');
    }

    public function edit($id)
    {
        $bundle = Bundle::with('products')->findOrFail($id);
        $products = Product::where('status', 'active')->get();
        return view('admin.bundles.edit', compact('bundle', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'products' => 'required|array|min:1',
            'products.*' => 'exists:products,id',
            'image' => 'nullable|image|mimes:webp',
        ]);

        $bundle = Bundle::findOrFail($id);

        $slug = Str::slug($request->title);
        if ($slug !== $bundle->slug) {
            $count = Bundle::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $id)->count();
            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }
        } else {
            $slug = $bundle->slug;
        }

        $data = [
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'status' => $request->status ?? 'draft',
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('bundles', 'public');
        }

        $bundle->update($data);

        // Use detach and attach to allow duplicate products (e.g. 2x Product A)
        // sync() would remove duplicates from the input array
        $bundle->products()->detach();
        $bundle->products()->attach($request->products);

        return redirect()->route('admin.bundles')->with('success', 'Bundle updated successfully.');
    }

    public function destroy($id)
    {
        $bundle = Bundle::findOrFail($id);
        $bundle->delete();
        return redirect()->route('admin.bundles')->with('success', 'Bundle deleted successfully.');
    }
}
