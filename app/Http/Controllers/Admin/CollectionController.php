<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Collection::withCount('products');

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Status Filter
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('status', true);
            } elseif ($request->status === 'draft') {
                $query->where('status', false);
            }
        }

        // Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $query->oldest();
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $collections = $query->paginate(10);

        if ($request->ajax()) {
            return view('admin.collections.partials.table', compact('collections'))->render();
        }

        return view('admin.collections.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.collections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:webp|max:2048',
            'status' => 'boolean',
        ]);

        $slug = Str::slug($request->name);
        
        // Ensure unique slug
        $count = Collection::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('collections', 'public');
        }

        Collection::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.collections')->with('success', 'Collection created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $collection = Collection::with(['products.images', 'products.variants'])->findOrFail($id);
        return view('admin.collections.show', compact('collection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $collection = Collection::findOrFail($id);
        return view('admin.collections.edit', compact('collection')); // We need to create this view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $collection = Collection::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:webp|max:2048',
            'status' => 'boolean',
        ]);

        $slug = Str::slug($request->name);
        if ($slug !== $collection->slug) {
             // Ensure unique slug if name changed
            $count = Collection::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $id)->count();
            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }
        } else {
            $slug = $collection->slug;
        }

        $imagePath = $collection->image;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($collection->image) {
                Storage::disk('public')->delete($collection->image);
            }
            $imagePath = $request->file('image')->store('collections', 'public');
        }

        $collection->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.collections')->with('success', 'Collection updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $collection = Collection::findOrFail($id);
        if ($collection->image) {
            Storage::disk('public')->delete($collection->image);
        }
        $collection->delete();

        return redirect()->route('admin.collections')->with('success', 'Collection deleted successfully.');
    }
}
