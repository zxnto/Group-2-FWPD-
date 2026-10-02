<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Food;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class FoodSystemTest extends TestCase
{
    use RefreshDatabase;

    private User $customer;

    private User $owner;

    private Restaurant $restaurant;

    private Category $category;

    private Food $food;

    protected function setUp(): void
    {
        parent::setUp();

        $this->owner = User::create([
            'name' => 'Owner Chef',
            'email' => 'owner@test.com',
            'role' => 'owner',
            'password' => Hash::make('password123'),
        ]);

        $this->customer = User::create([
            'name' => 'Customer Alex',
            'email' => 'customer@test.com',
            'phone' => '+15551234',
            'role' => 'customer',
            'password' => Hash::make('password123'),
        ]);

        $this->restaurant = Restaurant::create([
            'user_id' => $this->owner->id,
            'name' => 'Test Bistro',
            'is_active' => true,
        ]);

        $this->category = Category::create([
            'name' => 'Burgers',
            'slug' => 'burgers',
        ]);

        $this->food = Food::create([
            'restaurant_id' => $this->restaurant->id,
            'category_id' => $this->category->id,
            'name' => 'Cheeseburger Deluxe',
            'price' => 9.99,
            'image' => 'https://example.com/burger.jpg',
            'is_available' => true,
            'preparation_time' => 15,
        ]);
    }

    public function test_customer_can_view_home_menu(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Cheeseburger Deluxe');
        $response->assertSee('heroBannerCarousel');
    }

    public function test_head_bar_renders_with_language_switcher(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('top-head-bar');
        $response->assertSee('lang-switch-group');
        $response->assertSee('ភាសាខ្មែរ');
        $response->assertSee('English');
    }

    public function test_head_bar_renders_with_theme_switcher(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('theme-toggle-btn');
        $response->assertSee('theme-toggle-icon');
        $response->assertSee('toggleColorTheme()', false);
    }

    public function test_user_can_switch_language_to_english_and_khmer(): void
    {
        $response = $this->get('/lang/en');
        $response->assertRedirect();
        $response->assertSessionHas('locale', 'en');

        $homeEn = $this->withSession(['locale' => 'en'])->get('/');
        $homeEn->assertStatus(200);
        $homeEn->assertSee('All Dishes');

        $responseKm = $this->get('/lang/km');
        $responseKm->assertRedirect();
        $responseKm->assertSessionHas('locale', 'km');

        $homeKm = $this->withSession(['locale' => 'km'])->get('/');
        $homeKm->assertStatus(200);
        $homeKm->assertSee('មុខម្ហូបទាំងអស់');
    }

    public function test_customer_can_fetch_food_details_api(): void
    {
        $response = $this->getJson("/food/{$this->food->id}");
        $response->assertStatus(200)
            ->assertJson([
                'name' => 'Cheeseburger Deluxe',
                'price' => '9.99',
            ]);
    }

    public function test_cart_addition_and_totals(): void
    {
        $response = $this->postJson('/cart/add', [
            'food_id' => $this->food->id,
            'quantity' => 2,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'cart_count' => 2,
            ]);

        $this->assertEquals(2, session('cart')[$this->food->id]['quantity']);
    }

    public function test_customer_can_place_order_and_track_status(): void
    {
        // Add to session cart
        session()->put('cart', [
            $this->food->id => [
                'id' => $this->food->id,
                'name' => $this->food->name,
                'price' => 9.99,
                'quantity' => 1,
            ],
        ]);

        $response = $this->actingAs($this->customer)
            ->post('/checkout/place-order', [
                'customer_name' => 'Customer Alex',
                'customer_phone' => '+15551234',
                'delivery_address' => '123 Test Street, City',
                'payment_method' => 'cod',
            ]);

        $order = Order::where('user_id', $this->customer->id)->first();
        $this->assertNotNull($order);
        $this->assertEquals('Pending', $order->status);

        $response->assertRedirect(route('orders.show', $order->order_number));

        // Test track API endpoint
        $trackResponse = $this->actingAs($this->customer)
            ->getJson("/orders/{$order->order_number}/track-api");

        $trackResponse->assertStatus(200)
            ->assertJson([
                'status' => 'Pending',
            ]);
    }

    public function test_owner_can_access_dashboard_and_update_order_status(): void
    {
        $order = Order::create([
            'order_number' => 'ORD-TEST1234',
            'user_id' => $this->customer->id,
            'restaurant_id' => $this->restaurant->id,
            'delivery_address' => '123 Test Street',
            'customer_name' => 'Customer Alex',
            'customer_phone' => '+15551234',
            'subtotal' => 9.99,
            'delivery_fee' => 1.50,
            'total_amount' => 11.49,
            'status' => 'Pending',
            'payment_method' => 'cod',
        ]);

        // Non-owner cannot access owner dashboard
        $this->actingAs($this->customer)
            ->get('/owner/dashboard')
            ->assertRedirect(route('home'));

        // Owner can access owner dashboard
        $this->actingAs($this->owner)
            ->get('/owner/dashboard')
            ->assertStatus(200)
            ->assertSee('Business Dashboard');

        // Owner can advance order status: Pending -> Confirmed
        $this->actingAs($this->owner)
            ->post("/owner/orders/{$order->id}/status", [
                'status' => 'Confirmed',
            ])
            ->assertSessionHas('success');

        $order->refresh();
        $this->assertEquals('Confirmed', $order->status);
        $this->assertNotNull($order->confirmed_at);
    }
}
