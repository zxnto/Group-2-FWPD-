<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $restaurant = Restaurant::where('is_active', true)->first();
        $categories = Category::withCount(['foods' => function ($q) {
            $q->where('is_available', true);
        }])->get();

        $query = Food::with(['category', 'reviews.user'])
            ->where('is_available', true);

        // Search by keyword
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by category slug
        if ($categorySlug = $request->query('category')) {
            $category = Category::where('slug', $categorySlug)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Sort options
        $sort = $request->query('sort', 'popular');
        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $featuredFoods = Food::with(['category'])
            ->where('is_available', true)
            ->latest()
            ->take(3)
            ->get();

        $banners = collect();
        $isKm = app()->getLocale() === 'km';

        // 1. Restaurant Ambiance Slide
        $banners->push([
            'id' => null,
            'type' => 'restaurant',
            'badge' => __('messages.welcome_slide_badge'),
            'title' => $isKm ? ($restaurant->name ?? 'ភោជនីយដ្ឋាន មាសអប្សរា') : 'The Golden Apsara Royal Bistro',
            'subtitle' => __('messages.welcome_slide_subtitle'),
            'image' => $restaurant->image ?? 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=900&fit=crop',
            'btn_text' => __('messages.explore_menu'),
            'btn_icon' => 'bi-arrow-down-circle',
            'action' => 'scroll',
        ]);

        // 2. Featured Dishes Slides
        $dishBadges = $isKm ? [
            '⭐ មុខម្ហូបពិសេស • Royal Signature',
            '🔥 រសជាតិដើមខ្មែរ • Chef Recommended',
            '🍲 ម្ហូបឆ្ងាញ់ប្រចាំហាង • House Favorite',
        ] : [
            '⭐ Royal Signature Dish',
            '🔥 Chef Recommended',
            '🍲 House Favorite Special',
        ];

        foreach ($featuredFoods as $index => $food) {
            $banners->push([
                'id' => $food->id,
                'type' => 'food',
                'badge' => $dishBadges[$index % count($dishBadges)],
                'title' => $food->localized_name,
                'subtitle' => '$'.number_format($food->price, 2).' &bull; '.($food->category ? $food->category->localized_name : ($isKm ? 'ម្ហូបពិសេស' : 'Royal Delicacy')),
                'image' => $food->image,
                'btn_text' => __('messages.order_now'),
                'btn_icon' => 'bi-bag-plus',
                'action' => 'modal',
            ]);
        }

        // 3. ABA KHQR Promotion Slide
        $banners->push([
            'id' => null,
            'type' => 'promo',
            'badge' => __('messages.promo_slide_badge'),
            'title' => __('messages.promo_slide_title'),
            'subtitle' => __('messages.promo_slide_subtitle'),
            'image' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=900&fit=crop',
            'btn_text' => __('messages.explore_menu'),
            'btn_icon' => 'bi-stars',
            'action' => 'scroll',
        ]);

        $foods = $query->paginate(12)->withQueryString();

        return view('customer.home', compact('restaurant', 'categories', 'foods', 'banners'));
    }

    public function foodDetail(int $id): JsonResponse
    {
        $food = Food::with(['category', 'reviews.user'])->findOrFail($id);

        return response()->json([
            'id' => $food->id,
            'name' => $food->localized_name,
            'description' => $food->localized_description,
            'price' => number_format($food->price, 2),
            'image' => $food->image,
            'category' => $food->category ? $food->category->localized_name : 'General',
            'preparation_time' => $food->preparation_time,
            'average_rating' => $food->average_rating,
            'reviews_count' => $food->reviews_count,
            'reviews' => $food->reviews->take(5)->map(function ($review) {
                return [
                    'user_name' => $review->user ? $review->user->name : 'Anonymous',
                    'rating' => $review->rating,
                    'comment' => $review->localized_comment,
                    'date' => $review->created_at->diffForHumans(),
                ];
            }),
        ]);
    }
}
