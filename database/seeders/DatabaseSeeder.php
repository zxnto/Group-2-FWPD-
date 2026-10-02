<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Category;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Restaurant Owner
        $owner = User::create([
            'name' => 'Lokru Marco (Chef & Owner)',
            'email' => 'owner@fooddelivery.com',
            'phone' => '+855 12 345 678',
            'role' => 'owner',
            'address' => 'No. 88 Preah Norodom Blvd, Daun Penh, Phnom Penh',
            'password' => Hash::make('password123'),
            'avatar' => 'https://images.unsplash.com/photo-1577219491135-ce391730fb2c?w=200&h=200&fit=crop',
            'is_active' => true,
        ]);

        // 2. Create Demo Customer
        $customer = User::create([
            'name' => 'Sokha Alex Johnson',
            'email' => 'customer@fooddelivery.com',
            'phone' => '+855 98 765 432',
            'role' => 'customer',
            'address' => 'Street 240, Khan Daun Penh, Phnom Penh',
            'password' => Hash::make('password123'),
            'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=200&h=200&fit=crop',
            'is_active' => true,
        ]);

        $customer2 = User::create([
            'name' => 'Bopha Sarah Connor',
            'email' => 'sarah@example.com',
            'phone' => '+855 77 123 456',
            'role' => 'customer',
            'address' => 'BKK1, Street 51, Boeung Keng Kang, Phnom Penh',
            'password' => Hash::make('password123'),
            'avatar' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=200&h=200&fit=crop',
            'is_active' => true,
        ]);

        // 3. Create Restaurant with Royal Khmer Bistro Theme
        $restaurant = Restaurant::create([
            'user_id' => $owner->id,
            'name' => 'The Golden Apsara Royal Bistro (ភោជនីយដ្ឋាន មាសអប្សរា)',
            'description' => 'A royal dining experience celebrating authentic Khmer culinary heritage, artisanal stone-baked dishes, and golden gastronomy.',
            'phone' => '+855 23 999 888',
            'address' => 'Preah Norodom Boulevard, Sangkat Phsar Thmey, Phnom Penh, Cambodia',
            'image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=900&fit=crop',
            'is_active' => true,
        ]);

        // 4. Create Customer Addresses
        $homeAddress = Address::create([
            'user_id' => $customer->id,
            'label' => 'Home (ផ្ទះ)',
            'recipient_name' => 'Sokha Alex',
            'recipient_phone' => '+855 98 765 432',
            'address' => '#45, Street 240, Sangkat Chaktomuk',
            'city' => 'Phnom Penh',
            'province' => 'Phnom Penh',
            'postal_code' => '12207',
            'is_default' => true,
        ]);

        Address::create([
            'user_id' => $customer->id,
            'label' => 'Office (ការិយាល័យ)',
            'recipient_name' => 'Sokha Alex',
            'recipient_phone' => '+855 98 765 432',
            'address' => 'Vattanac Capital Tower, Level 18, Preah Monivong Blvd',
            'city' => 'Phnom Penh',
            'province' => 'Phnom Penh',
            'postal_code' => '12202',
            'is_default' => false,
        ]);

        // 5. Create Categories with Khmer Names
        $categories = [
            [
                'name' => 'Khmer Royal Cuisine (ម្ហូបខ្មែរបុរាណ)',
                'slug' => 'khmer-royal-cuisine',
                'description' => 'Authentic Cambodian signature dishes prepared with fresh lemongrass kroeung & coconut cream',
                'icon' => 'bi-gem',
                'image' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=400&fit=crop',
            ],
            [
                'name' => 'Kuy Teav & Noodles (គុយទាវ និង មី)',
                'slug' => 'kuy-teav-noodles',
                'description' => 'Simmering Phnom Penh bone broths and handmade silk noodles',
                'icon' => 'bi-egg-fried',
                'image' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=400&fit=crop',
            ],
            [
                'name' => 'Burgers & Western Fusion (ប៊ឺហ្គឺ)',
                'slug' => 'burgers-fusion',
                'description' => 'Juicy prime Angus burgers enhanced with Kampot pepper aioli',
                'icon' => 'bi-fire',
                'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400&fit=crop',
            ],
            [
                'name' => 'Artisan Pizzas (ភីហ្សា)',
                'slug' => 'artisan-pizzas',
                'description' => 'Wood-fired crispy crusts with Italian buffalo mozzarella',
                'icon' => 'bi-pie-chart-fill',
                'image' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?w=400&fit=crop',
            ],
            [
                'name' => 'Khmer Coffee & Drinks (ភេសជ្ជៈ និង កាហ្វេ)',
                'slug' => 'drinks-coffee',
                'description' => 'Traditional roasted Robusta iced coffee and royal herbal teas',
                'icon' => 'bi-cup-hot-fill',
                'image' => 'https://images.unsplash.com/photo-1517701604599-bb29b565090c?w=400&fit=crop',
            ],
            [
                'name' => 'Royal Desserts (បង្អែមខ្មែរ)',
                'slug' => 'royal-desserts',
                'description' => 'Sweet palm sugar delicacies, warm lava cakes and coconut sticky rice',
                'icon' => 'bi-cake2-fill',
                'image' => 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=400&fit=crop',
            ],
        ];

        $categoryModels = [];
        foreach ($categories as $catData) {
            $categoryModels[$catData['slug']] = Category::create($catData);
        }

        // 6. Create Food Items (Rich Authentic Khmer Specialties + International favorites)
        $foods = [
            // Khmer Royal Cuisine
            [
                'restaurant_id' => $restaurant->id,
                'category_id' => $categoryModels['khmer-royal-cuisine']->id,
                'name' => 'Royal Fish Amok in Banana Leaf (អាម៉ុកត្រី)',
                'description' => 'Steamed Mekong river fish gently simmered in yellow lemongrass kroeung, coconut milk, kaffir lime, and noni leaves served in an ornate woven banana leaf cup.',
                'price' => 8.50,
                'image' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=600&fit=crop',
                'is_available' => true,
                'preparation_time' => 20,
            ],
            [
                'restaurant_id' => $restaurant->id,
                'category_id' => $categoryModels['khmer-royal-cuisine']->id,
                'name' => 'Wok-Fried Beef Lok Lak with Kampot Pepper (ឡុកឡាក់សាច់គោ)',
                'description' => 'Tender cubes of marinated beef quickly seared in savory brown sauce, served over crisp red onions, fresh lettuce, and our signature Kampot black pepper lime dipping sauce.',
                'price' => 7.99,
                'image' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=600&fit=crop',
                'is_available' => true,
                'preparation_time' => 15,
            ],
            [
                'restaurant_id' => $restaurant->id,
                'category_id' => $categoryModels['khmer-royal-cuisine']->id,
                'name' => 'Golden Khmer Red Curry Chicken (ការីក្រហមខ្មែរ)',
                'description' => 'Fragrant Cambodian red curry with free-range chicken, sweet sweet potatoes, eggplant, and long beans in rich coconut broth, accompanied by warm crusty French baguette.',
                'price' => 6.75,
                'image' => 'https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?w=600&fit=crop',
                'is_available' => true,
                'preparation_time' => 18,
            ],
            [
                'restaurant_id' => $restaurant->id,
                'category_id' => $categoryModels['khmer-royal-cuisine']->id,
                'name' => 'Charcoal Lemongrass Beef Skewers (សាច់គោអាំងគ្រឿង)',
                'description' => 'Charcoal-grilled beef skewers marinated in fragrant galangal kroeung, served with pickled green papaya salad and crushed roasted peanuts.',
                'price' => 5.50,
                'image' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=600&fit=crop',
                'is_available' => true,
                'preparation_time' => 12,
            ],

            // Kuy Teav & Noodles
            [
                'restaurant_id' => $restaurant->id,
                'category_id' => $categoryModels['kuy-teav-noodles']->id,
                'name' => 'Classic Phnom Penh Kuy Teav Special (គុយទាវភ្នំពេញ)',
                'description' => 'Steaming 12-hour pork and dried squid broth, thin rice noodles, sliced pork loin, minced pork, fresh shrimp, fried garlic crisps, and fragrant celery leaves.',
                'price' => 5.00,
                'image' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=600&fit=crop',
                'is_available' => true,
                'preparation_time' => 10,
            ],
            [
                'restaurant_id' => $restaurant->id,
                'category_id' => $categoryModels['kuy-teav-noodles']->id,
                'name' => 'Traditional Nom Banh Chok Khmer (នំបញ្ចុកសម្លខ្មែរ)',
                'description' => 'Silky fermented rice noodles drenched in aromatic green fish lemongrass gravy, topped with fresh banana blossoms, cucumber, long beans, and sweet holy basil.',
                'price' => 4.50,
                'image' => 'https://images.unsplash.com/photo-1559847844-5315695dadae?w=600&fit=crop',
                'is_available' => true,
                'preparation_time' => 10,
            ],
            [
                'restaurant_id' => $restaurant->id,
                'category_id' => $categoryModels['kuy-teav-noodles']->id,
                'name' => 'Spicy Seafood Mi Char Stir-Fry (មីឆាគ្រឿងសមុទ្រ)',
                'description' => 'Wok-tossed yellow egg noodles with fresh Mekong squid, tiger prawns, crisp morning glory, egg, and sweet-savory oyster reduction.',
                'price' => 5.50,
                'image' => 'https://images.unsplash.com/photo-1612927601601-6638404737ce?w=600&fit=crop',
                'is_available' => true,
                'preparation_time' => 12,
            ],

            // Burgers & Fusion
            [
                'restaurant_id' => $restaurant->id,
                'category_id' => $categoryModels['burgers-fusion']->id,
                'name' => 'Angkor Gold Black Angus Burger',
                'description' => 'Prime Angus patty glazed with Kampot green peppercorn glaze, melted mature cheese, smoked bacon, and caramelized onions on gilded brioche.',
                'price' => 11.50,
                'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=600&fit=crop',
                'is_available' => true,
                'preparation_time' => 15,
            ],
            [
                'restaurant_id' => $restaurant->id,
                'category_id' => $categoryModels['burgers-fusion']->id,
                'name' => 'Spicy Golden Crispy Chicken Burger',
                'description' => 'Crispy golden battered chicken fillet with sweet chili slaw, melted pepperjack cheese, and homemade kaffir lime aioli.',
                'price' => 8.50,
                'image' => 'https://images.unsplash.com/photo-1625813506062-0aeb1d7a094b?w=600&fit=crop',
                'is_available' => true,
                'preparation_time' => 12,
            ],

            // Artisan Pizzas
            [
                'restaurant_id' => $restaurant->id,
                'category_id' => $categoryModels['artisan-pizzas']->id,
                'name' => 'Kampot Pepper Pepperoni Pizza',
                'description' => 'Double smoked cured pepperoni, San Marzano tomato sauce, molten mozzarella, and freshly cracked organic Kampot black pepper with spicy honey drizzle.',
                'price' => 13.50,
                'image' => 'https://images.unsplash.com/photo-1534308983496-4fabb1a015ee?w=600&fit=crop',
                'is_available' => true,
                'preparation_time' => 18,
            ],
            [
                'restaurant_id' => $restaurant->id,
                'category_id' => $categoryModels['artisan-pizzas']->id,
                'name' => 'Stone-Baked Truffle Mushroom Margherita',
                'description' => 'Fresh whole milk buffalo mozzarella, wild shiitake & oyster mushrooms, sweet basil leaves, and white truffle oil drizzle.',
                'price' => 12.99,
                'image' => 'https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?w=600&fit=crop',
                'is_available' => true,
                'preparation_time' => 18,
            ],

            // Drinks & Coffee
            [
                'restaurant_id' => $restaurant->id,
                'category_id' => $categoryModels['drinks-coffee']->id,
                'name' => 'Traditional Khmer Iced Milk Coffee (កាហ្វេទឹកដោះគោទឹកកក)',
                'description' => 'Slow-dripped dark roasted Cambodian mountain coffee layered generously over sweetened condensed milk and crushed ice.',
                'price' => 2.50,
                'image' => 'https://images.unsplash.com/photo-1517701604599-bb29b565090c?w=600&fit=crop',
                'is_available' => true,
                'preparation_time' => 4,
            ],
            [
                'restaurant_id' => $restaurant->id,
                'category_id' => $categoryModels['drinks-coffee']->id,
                'name' => 'Royal Jasmine Green Tea with Passion Fruit',
                'description' => 'Freshly brewed fragrant jasmine blossom tea shaken with fresh Kep passion fruit pulp and organic wild honey.',
                'price' => 3.00,
                'image' => 'https://images.unsplash.com/photo-1556881286-fc6915169721?w=600&fit=crop',
                'is_available' => true,
                'preparation_time' => 3,
            ],
            [
                'restaurant_id' => $restaurant->id,
                'category_id' => $categoryModels['drinks-coffee']->id,
                'name' => 'Golden Brown Sugar Boba Fresh Milk',
                'description' => 'Warm caramelized brown sugar tapioca pearls with fresh organic milk and golden torched cream cap.',
                'price' => 3.50,
                'image' => 'https://images.unsplash.com/photo-1558857563-b371033873b8?w=600&fit=crop',
                'is_available' => true,
                'preparation_time' => 4,
            ],

            // Royal Desserts
            [
                'restaurant_id' => $restaurant->id,
                'category_id' => $categoryModels['royal-desserts']->id,
                'name' => 'Sweet Mango Sticky Rice with Coconut Cream (បាយដំណើបស្វាយ)',
                'description' => 'Fragrant warm sticky rice infused with coconut milk and pandan essence, paired with ripe sweet golden mango slices and toasted sesame.',
                'price' => 4.50,
                'image' => 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=600&fit=crop',
                'is_available' => true,
                'preparation_time' => 8,
            ],
            [
                'restaurant_id' => $restaurant->id,
                'category_id' => $categoryModels['royal-desserts']->id,
                'name' => 'Belgian Molten Chocolate Lava Cake',
                'description' => 'Warm rich dark chocolate cake with a flowing molten core, dusted with edible golden flakes and served with coconut gelato.',
                'price' => 5.50,
                'image' => 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=600&fit=crop',
                'is_available' => true,
                'preparation_time' => 10,
            ],
        ];

        $foodModels = [];
        foreach ($foods as $foodData) {
            $foodModels[] = Food::create($foodData);
        }

        // 7. Seed Authentic Reviews
        Review::create([
            'user_id' => $customer->id,
            'food_id' => $foodModels[0]->id, // Fish Amok
            'rating' => 5,
            'comment' => 'ម្ហូបឆ្ងាញ់ខ្លាំងណាស់! (Super delicious!). The fish amok is authentic, creamy, and fragrant with kroeung.',
        ]);

        Review::create([
            'user_id' => $customer2->id,
            'food_id' => $foodModels[1]->id, // Lok Lak
            'rating' => 5,
            'comment' => 'The Kampot pepper sauce elevates this Lok Lak to another level. Five stars!',
        ]);

        Review::create([
            'user_id' => $customer->id,
            'food_id' => $foodModels[4]->id, // Kuy Teav
            'rating' => 5,
            'comment' => 'Best Kuy Teav in Phnom Penh. Clear flavorful broth and very generous toppings.',
        ]);

        // 8. Seed Demo Orders for Presentation
        // Order 1: Delivered
        $order1 = Order::create([
            'order_number' => 'ORD-'.strtoupper(uniqid()),
            'user_id' => $customer->id,
            'restaurant_id' => $restaurant->id,
            'address_id' => $homeAddress->id,
            'delivery_address' => $homeAddress->address.', '.$homeAddress->city,
            'customer_name' => $customer->name,
            'customer_phone' => $customer->phone,
            'subtotal' => 16.49,
            'delivery_fee' => 1.50,
            'total_amount' => 17.99,
            'status' => 'Delivered',
            'payment_method' => 'abapay',
            'payment_status' => 'paid',
            'notes' => 'សូមដាក់ទឹកត្រីម្ទេសបន្ថែម (Please include extra chili fish sauce)',
            'confirmed_at' => now()->subMinutes(60),
            'preparing_at' => now()->subMinutes(45),
            'out_for_delivery_at' => now()->subMinutes(25),
            'delivered_at' => now()->subMinutes(5),
            'created_at' => now()->subMinutes(70),
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'food_id' => $foodModels[0]->id,
            'food_name' => $foodModels[0]->name,
            'quantity' => 1,
            'price' => $foodModels[0]->price,
            'subtotal' => $foodModels[0]->price,
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'food_id' => $foodModels[1]->id,
            'food_name' => $foodModels[1]->name,
            'quantity' => 1,
            'price' => $foodModels[1]->price,
            'subtotal' => $foodModels[1]->price,
        ]);

        Payment::create([
            'order_id' => $order1->id,
            'payment_method' => 'abapay',
            'transaction_id' => 'ABA-KHQR-998822',
            'amount' => 17.99,
            'status' => 'paid',
            'payload' => json_encode(['bank' => 'ABA Pay KHQR', 'currency' => 'USD', 'status' => 'SUCCESS']),
            'paid_at' => now()->subMinutes(69),
        ]);

        // Order 2: Out for Delivery (Live tracking)
        $order2 = Order::create([
            'order_number' => 'ORD-'.strtoupper(uniqid()),
            'user_id' => $customer->id,
            'restaurant_id' => $restaurant->id,
            'address_id' => $homeAddress->id,
            'delivery_address' => $homeAddress->address.', '.$homeAddress->city,
            'customer_name' => $customer->name,
            'customer_phone' => $customer->phone,
            'subtotal' => 11.50,
            'delivery_fee' => 1.50,
            'total_amount' => 13.00,
            'status' => 'Out for Delivery',
            'payment_method' => 'abapay',
            'payment_status' => 'paid',
            'notes' => 'Call upon reaching gate',
            'confirmed_at' => now()->subMinutes(20),
            'preparing_at' => now()->subMinutes(15),
            'out_for_delivery_at' => now()->subMinutes(5),
            'created_at' => now()->subMinutes(25),
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'food_id' => $foodModels[4]->id,
            'food_name' => $foodModels[4]->name,
            'quantity' => 1,
            'price' => $foodModels[4]->price,
            'subtotal' => $foodModels[4]->price,
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'food_id' => $foodModels[11]->id,
            'food_name' => $foodModels[11]->name,
            'quantity' => 1,
            'price' => $foodModels[11]->price,
            'subtotal' => $foodModels[11]->price,
        ]);

        Payment::create([
            'order_id' => $order2->id,
            'payment_method' => 'abapay',
            'transaction_id' => 'ABA-KHQR-771122',
            'amount' => 13.00,
            'status' => 'paid',
            'payload' => json_encode(['bank' => 'ABA Pay KHQR', 'currency' => 'USD']),
            'paid_at' => now()->subMinutes(24),
        ]);

        // Order 3: Pending Order
        $order3 = Order::create([
            'order_number' => 'ORD-'.strtoupper(uniqid()),
            'user_id' => $customer2->id,
            'restaurant_id' => $restaurant->id,
            'address_id' => null,
            'delivery_address' => 'BKK1, Street 51, Phnom Penh',
            'customer_name' => $customer2->name,
            'customer_phone' => $customer2->phone,
            'subtotal' => 14.00,
            'delivery_fee' => 1.50,
            'total_amount' => 15.50,
            'status' => 'Pending',
            'payment_method' => 'cod',
            'payment_status' => 'pending',
            'notes' => 'Have change for $20 bill',
            'created_at' => now()->subMinutes(2),
        ]);

        OrderItem::create([
            'order_id' => $order3->id,
            'food_id' => $foodModels[7]->id,
            'food_name' => $foodModels[7]->name,
            'quantity' => 1,
            'price' => $foodModels[7]->price,
            'subtotal' => $foodModels[7]->price,
        ]);

        Payment::create([
            'order_id' => $order3->id,
            'payment_method' => 'cod',
            'amount' => 15.50,
            'status' => 'pending',
        ]);
    }
}
