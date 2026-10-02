<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('foods')->get();

        return view('owner.categories.index', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|max:2048',
            'icon' => 'nullable|string|max:50',
        ]);

        $imagePath = $validated['image'] ?? null;
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('categories', 'public');
            $imagePath = Storage::url($path);
        }

        if (empty($imagePath)) {
            $imagePath = 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=400&fit=crop';
        }

        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'image' => $imagePath,
            'icon' => $validated['icon'] ?? 'bi-tag',
        ]);

        return redirect()->route('owner.categories.index')->with('success', 'Category created successfully!');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,'.$id,
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|max:2048',
            'icon' => 'nullable|string|max:50',
        ]);

        $imagePath = $category->image;
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('categories', 'public');
            $imagePath = Storage::url($path);
        } elseif (! empty($validated['image'])) {
            $imagePath = $validated['image'];
        }

        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'image' => $imagePath,
            'icon' => $validated['icon'] ?? $category->icon,
        ]);

        return redirect()->route('owner.categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy(int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $name = $category->name;
        $category->delete();

        return redirect()->route('owner.categories.index')->with('success', "Category '{$name}' removed.");
    }
}
