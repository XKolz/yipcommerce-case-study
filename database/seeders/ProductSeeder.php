<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'AeroLite Travel Backpack',
                'description' => 'A weather-resistant backpack with padded laptop storage, expandable packing space, and quick-access side pockets for daily commutes or weekend travel.',
                'price' => 48900,
                'image' => 'https://images.unsplash.com/photo-1622560480605-d83c853bc5c3?auto=format&fit=crop&w=900&q=80',
                'stock' => 18,
            ],
            [
                'name' => 'Nordic Desk Lamp',
                'description' => 'A compact LED desk lamp with adjustable warmth levels, matte metal finish, and a steady weighted base for focused workspaces.',
                'price' => 32500,
                'image' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?auto=format&fit=crop&w=900&q=80',
                'stock' => 24,
            ],
            [
                'name' => 'Pulse Wireless Headphones',
                'description' => 'Comfortable over-ear headphones with balanced audio, noise isolation, and long battery life for work calls, music, and travel.',
                'price' => 76900,
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=900&q=80',
                'stock' => 15,
            ],
            [
                'name' => 'Stoneware Coffee Set',
                'description' => 'A hand-finished ceramic coffee set with two mugs and a matching pour-over dripper, designed for slow mornings and thoughtful gifting.',
                'price' => 28600,
                'image' => 'https://images.unsplash.com/photo-1517256064527-09c73fc73e38?auto=format&fit=crop&w=900&q=80',
                'stock' => 20,
            ],
            [
                'name' => 'Urban Runner Sneakers',
                'description' => 'Lightweight everyday sneakers with breathable knit uppers, cushioned soles, and clean styling that works beyond the gym.',
                'price' => 59900,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=900&q=80',
                'stock' => 30,
            ],
            [
                'name' => 'Bamboo Kitchen Scale',
                'description' => 'A precise digital kitchen scale with a natural bamboo surface, tare controls, and a slim profile for easy storage.',
                'price' => 21900,
                'image' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?auto=format&fit=crop&w=900&q=80',
                'stock' => 28,
            ],
            [
                'name' => 'Linen Throw Blanket',
                'description' => 'A soft textured throw blanket made for couches, reading chairs, and layered bedrooms, finished with a subtle fringe edge.',
                'price' => 41200,
                'image' => 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?auto=format&fit=crop&w=900&q=80',
                'stock' => 16,
            ],
            [
                'name' => 'Focus Standing Mat',
                'description' => 'An anti-fatigue mat with supportive cushioning and beveled edges for standing desks, studios, and service counters.',
                'price' => 35800,
                'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=900&q=80',
                'stock' => 12,
            ],
            [
                'name' => 'Minimal Leather Wallet',
                'description' => 'A slim leather wallet with RFID lining, quick card access, and a refined profile that fits front pockets cleanly.',
                'price' => 26400,
                'image' => 'https://images.unsplash.com/photo-1627123424574-724758594e93?auto=format&fit=crop&w=900&q=80',
                'stock' => 35,
            ],
            [
                'name' => 'Smart Hydration Bottle',
                'description' => 'A stainless bottle with double-wall insulation, hydration reminders, and a leak-resistant cap for busy workdays.',
                'price' => 29700,
                'image' => 'https://images.unsplash.com/photo-1602143407151-7111542de6e8?auto=format&fit=crop&w=900&q=80',
                'stock' => 22,
            ],
        ];

        foreach ($products as $product) {
            Product::query()->firstOrCreate(
                ['slug' => Str::slug($product['name'])],
                $product + ['status' => 'active'],
            );
        }
    }
}
