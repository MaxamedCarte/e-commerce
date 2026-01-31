<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User']
        );

        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );

        $categories = [
            'Electronics',
            'Fashion',
            'Home & Kitchen',
            'Sports',
            'Books'
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }

        $electronics = Category::where('name', 'Electronics')->first();
        $fashion = Category::where('name', 'Fashion')->first();
        $home = Category::where('name', 'Home & Kitchen')->first();
        $sports = Category::where('name', 'Sports')->first();
        $books = Category::where('name', 'Books')->first();

        $products = [
            // Electronics
            [
                'name' => 'Wireless Noise Cancelling Headphones',
                'category_id' => $electronics->id,
                'description' => 'Premium over-ear headphones with industry-leading noise cancellation, crystal clear audio, and 30-hour battery life.',
                'price' => 299.99,
                'stock' => 50,
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'name' => 'Smartphone 14 Pro',
                'category_id' => $electronics->id,
                'description' => 'Latest flagship smartphone with advanced camera system, super retina XDR display, and A16 Bionic chip.',
                'price' => 999.00,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'name' => '4K Ultra HD Smart TV',
                'category_id' => $electronics->id,
                'description' => 'Experience cinematic visuals with this 55-inch 4K Smart TV featuring HDR10+ and built-in streaming apps.',
                'price' => 450.00,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1593784991095-a20506948430?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'name' => 'Smart Watch Series 8',
                'category_id' => $electronics->id,
                'description' => 'Advanced health sensors, always-on display, and crash detection. The ultimate companion for a healthy life.',
                'price' => 399.00,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=600&q=80',
            ],
            // Fashion
            [
                'name' => 'Men\'s Classic Denim Jacket',
                'category_id' => $fashion->id,
                'description' => 'A timeless classic denim jacket for men, featuring a comfortable fit and durable denim fabric.',
                'price' => 59.99,
                'stock' => 40,
                'image' => 'https://images.unsplash.com/photo-1620247409618-0a76cf85458f?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'name' => 'Women\'s Running Shoes',
                'category_id' => $fashion->id,
                'description' => 'Lightweight and breathable running shoes designed for speed and comfort. Perfect for your daily run.',
                'price' => 85.00,
                'stock' => 35,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'name' => 'Leather Wallet',
                'category_id' => $fashion->id,
                'description' => 'Genuine leather wallet with multiple card slots and a sleek design.',
                'price' => 45.00,
                'stock' => 60,
                'image' => 'https://images.unsplash.com/photo-1627123424574-18bd0317e5e7?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'name' => 'Aviator Sunglasses',
                'category_id' => $fashion->id,
                'description' => 'Classic aviator sunglasses with UV protection and durable metal frame.',
                'price' => 120.00,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?auto=format&fit=crop&w=600&q=80',
            ],
            // Home & Kitchen
            [
                'name' => 'Stainless Steel Cookware Set',
                'category_id' => $home->id,
                'description' => 'Complete 10-piece stainless steel cookware set including pots, pans, and lids. Dishwasher safe.',
                'price' => 129.99,
                'stock' => 10,
                'image' => 'https://images.unsplash.com/photo-1583321500900-8287645f7f27?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'name' => 'Modern Coffee Maker',
                'category_id' => $home->id,
                'description' => 'Brew the perfect cup of coffee with this programmable coffee maker. Features auto-shutoff and keep-warm function.',
                'price' => 49.99,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1517668808822-9ebb02f2a0e6?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'name' => 'Robot Vacuum Cleaner',
                'category_id' => $home->id,
                'description' => 'Smart robot vacuum with mapping technology and app control. Keeps your floors clean automatically.',
                'price' => 249.00,
                'stock' => 12,
                'image' => 'https://images.unsplash.com/photo-1518640467707-6811f4a6ab73?auto=format&fit=crop&w=600&q=80',
            ],
            // Sports
            [
                'name' => 'Non-Slip Yoga Mat',
                'category_id' => $sports->id,
                'description' => 'Eco-friendly non-slip yoga mat with extra cushioning for joint support.',
                'price' => 29.99,
                'stock' => 45,
                'image' => 'https://images.unsplash.com/photo-1601925260368-ae2f83cf8b7f?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'name' => 'Adjustable Dumbbell Set',
                'category_id' => $sports->id,
                'description' => 'Compact adjustable dumbbell set ranging from 5 to 52.5 lbs. Perfect for home gyms.',
                'price' => 199.00,
                'stock' => 8,
                'image' => 'https://images.unsplash.com/photo-1638536532686-d610adfc8e5c?auto=format&fit=crop&w=600&q=80',
            ],
            // Books
            [
                'name' => 'The Great Adventure',
                'category_id' => $books->id,
                'description' => 'An epic tale of courage and discovery in a fantasy world.',
                'price' => 19.99,
                'stock' => 100,
                'image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'name' => 'Healthy Cooking 101',
                'category_id' => $books->id,
                'description' => 'A comprehensive guide to cooking healthy and delicious meals at home.',
                'price' => 24.99,
                'stock' => 75,
                'image' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=600&q=80',
            ],
        ];

        foreach ($products as $productData) {
            Product::updateOrCreate(
                ['name' => $productData['name']],
                $productData
            );
        }
    }
}
