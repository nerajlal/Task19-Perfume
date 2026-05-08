<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bundle;
use App\Models\Product;
use App\Models\ProductVariant;
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

        // Type Filter (Tabs)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        } else {
            $query->where('type', 'bundle'); // Default to bundles tab
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
            'type' => 'bundle',
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

        // For "Pack" type, we don't want to lose the quantity and variant_id during simple edits
        if ($bundle->type == 'pack') {
            // Keep the same product connection but update basic info
            // (The products array in request will only have the one product ID)
            // No changes needed to the pivot for simple edits (title/status/price)
        } else {
            // Standard bundle update: Use detach and attach to allow duplicate products
            $bundle->products()->detach();
            $bundle->products()->attach($request->products);
        }

        return redirect()->route('admin.bundles')->with('success', 'Bundle updated successfully.');
    }

    public function destroy($id)
    {
        $bundle = Bundle::findOrFail($id);
        $bundle->delete();
        return redirect()->route('admin.bundles')->with('success', 'Bundle deleted successfully.');
    }

    public function storePackOf(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:2',
            'pack_price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($request->product_id);
        $variant = ProductVariant::findOrFail($request->variant_id);

        $title = "Pack of {$request->quantity} - {$product->title} - {$variant->size}";
        $slug = Str::slug($title);
        
        // Ensure unique slug
        $count = Bundle::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        // Calculate discount value to reach the desired pack price
        // Original total = variant price * quantity
        $originalTotal = $variant->price * $request->quantity;
        $discountValue = $originalTotal - $request->pack_price;

        $bundle = Bundle::create([
            'title' => $title,
            'slug' => $slug,
            'type' => 'pack',
            'description' => "Special curated pack of {$request->quantity} units of {$product->title} ({$variant->size}).",
            'status' => 'active',
            'discount_type' => 'fixed',
            'discount_value' => max(0, $discountValue),
        ]);

        // Attach the product with quantity and variant_id
        $bundle->products()->attach($product->id, [
            'quantity' => $request->quantity,
            'product_variant_id' => $variant->id
        ]);

        return redirect()->route('admin.bundles')->with('success', "Pack of {$request->quantity} created successfully.");
    }
}
