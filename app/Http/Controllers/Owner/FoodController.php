<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FoodController extends Controller
{
    public function index(Request $request): View
    {
        $query = Food::with('category')->latest();

        if ($search = $request->query('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($catId = $request->query('category_id')) {
            $query->where('category_id', $catId);
        }

        $foods = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('owner.foods.index', compact('foods', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::all();

        return view('owner.foods.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0.01|max:9999.99',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|url|max:500',
            'is_available' => 'nullable|boolean',
            'preparation_time' => 'required|integer|min:1|max:180',
        ]);

        $restaurant = Restaurant::first();

        $imagePath = $validated['image_url'] ?? null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('foods', 'public');
            $imagePath = Storage::url($path);
        }

        if (empty($imagePath)) {
            $imagePath = 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&fit=crop';
        }

        Food::create([
            'restaurant_id' => $restaurant ? $restaurant->id : null,
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'image' => $imagePath,
            'is_available' => $request->boolean('is_available', true),
            'preparation_time' => $validated['preparation_time'],
        ]);

        return redirect()->route('owner.foods.index')->with('success', 'Food item added to menu successfully!');
    }

    public function edit(int $id): View
    {
        $food = Food::findOrFail($id);
        $categories = Category::all();

        return view('owner.foods.edit', compact('food', 'categories'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $food = Food::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0.01|max:9999.99',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|url|max:500',
            'is_available' => 'nullable|boolean',
            'preparation_time' => 'required|integer|min:1|max:180',
        ]);

        $imagePath = $food->image;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('foods', 'public');
            $imagePath = Storage::url($path);
        } elseif (! empty($validated['image_url'])) {
            $imagePath = $validated['image_url'];
        }

        $food->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'image' => $imagePath,
            'is_available' => $request->boolean('is_available', true),
            'preparation_time' => $validated['preparation_time'],
        ]);

        return redirect()->route('owner.foods.index')->with('success', 'Food item updated successfully!');
    }

    public function destroy(int $id): RedirectResponse
    {
        $food = Food::findOrFail($id);
        $name = $food->name;
        $food->delete();

        return redirect()->route('owner.foods.index')->with('success', "Item '{$name}' deleted successfully.");
    }

    public function toggleAvailability(int $id): JsonResponse|RedirectResponse
    {
        $food = Food::findOrFail($id);
        $food->is_available = ! $food->is_available;
        $food->save();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'is_available' => $food->is_available,
                'message' => $food->is_available ? 'Item marked as Available' : 'Item marked as Unavailable',
            ]);
        }

        $statusStr = $food->is_available ? 'Available' : 'Unavailable';

        return back()->with('success', "'{$food->name}' is now marked as {$statusStr}.");
    }
}
