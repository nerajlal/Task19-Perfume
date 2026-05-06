<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'title' => 'Amber Elixir',
                'image' => 'images/product-amber-elixir.webp',
                'type' => 'Perfume Oil',
                'vendor' => 'Nurah',
                'price' => 1299.00,
            ],
            [
                'title' => 'Bangalore Bloom',
                'image' => 'images/product-bangalore-bloom.webp',
                'type' => 'Eau de Parfum',
                'vendor' => 'Nurah',
                'price' => 1499.00,
            ],
            [
                'title' => 'California Sunshine',
                'image' => 'images/product-california-sunshine.webp',
                'type' => 'Body Mist',
                'vendor' => 'Nurah',
                'price' => 899.00,
            ],
            [
                'title' => 'Fruit Punch',
                'image' => 'images/product-fruit-punch.webp',
                'type' => 'Perfume Oil',
                'vendor' => 'Nurah',
                'price' => 999.00,
            ],
            [
                'title' => 'Marshmallow Fluff',
                'image' => 'images/product-marshmallow-fluff.webp',
                'type' => 'Eau de Toilette',
                'vendor' => 'SweetScents',
                'price' => 1150.00,
            ],
            [
                'title' => 'Midnight Jasmine',
                'image' => 'images/product-midnight-jasmine.webp',
                'type' => 'Perfume Oil',
                'vendor' => 'Nurah',
                'price' => 1350.00,
            ],
            [
                'title' => 'Moroccan Rose',
                'image' => 'images/product-moroccan-rose.webp',
                'type' => 'Eau de Parfum',
                'vendor' => 'Nurah',
                'price' => 1599.00,
            ],
            [
                'title' => 'One of a Kind',
                'image' => 'images/product-one-of-a-kind.webp',
                'type' => 'Eau de Parfum',
                'vendor' => 'Nurah',
                'price' => 2499.00,
            ],
            [
                'title' => 'Oud de Beirut',
                'image' => 'images/product-oud-de-beirut.webp',
                'type' => 'Oud',
                'vendor' => 'Nurah',
                'price' => 2999.00,
            ],
            [
                'title' => 'Parisian Night',
                'image' => 'images/product-parisian-night.webp',
                'type' => 'Eau de Parfum',
                'vendor' => 'Nurah',
                'price' => 1899.00,
            ],
            [
                'title' => 'Purple Mystique',
                'image' => 'images/product-purple-mystique.webp',
                'type' => 'Body Mist',
                'vendor' => 'Nurah',
                'price' => 799.00,
            ],
            [
                'title' => 'Sandal Veer',
                'image' => 'images/product-sandal-veer.webp',
                'type' => 'Attar',
                'vendor' => 'Nurah',
                'price' => 599.00,
            ],
        ];

        // Ensure collections exist
        $collections = Collection::all();
        $tenant = \App\Models\Tenant::first();

        foreach ($products as $data) {
            $product = Product::create([
                'tenant_id' => $tenant->id,
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'description' => "Experience the enchanting aroma of {$data['title']}. A perfect blend for any occasion.",
                'status' => 'active',
                'type' => $data['type'],
                'vendor' => $data['vendor'],
                'collection_id' => $collections->isNotEmpty() ? $collections->random()->id : null,
                'gender' => collect(['Men', 'Women', 'Unisex'])->random(),
                'olfactory_family' => collect(['Floral', 'Woody', 'Fresh', 'Oriental'])->random(),
                'intensity' => collect(['Light', 'Moderate', 'Strong'])->random(),
            ]);

            // Define available extra images pool
            $extraImages = [
                'images/product-amber-elixir.webp',
                'images/product-bangalore-bloom.webp',
                'images/product-california-sunshine.webp',
                'images/product-fruit-punch.webp',
                'images/product-marshmallow-fluff.webp',
                'images/product-midnight-jasmine.webp',
                'images/product-moroccan-rose.webp',
                'images/product-one-of-a-kind.webp',
                'images/product-oud-de-beirut.webp',
                'images/product-parisian-night.webp',
                'images/product-purple-mystique.webp',
                'images/product-sandal-veer.webp',
            ];

            // Add Main Image
            ProductImage::create([
                'product_id' => $product->id,
                'path' => $data['image'],
                'type' => 'main',
                'order' => 1,
            ]);

            // Add 3-6 Additional Images
            $additionalImagesCount = rand(3, 6);
            for ($i = 0; $i < $additionalImagesCount; $i++) {
                $randomImage = $extraImages[array_rand($extraImages)];
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $randomImage,
                    'type' => 'gallery',
                    'order' => $i + 2,
                ]);
            }

            // Add Variants (Example: Sizes)
            $sizes = ['50ml', '100ml'];
            foreach ($sizes as $index => $size) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'sku' => Str::upper(Str::slug($data['title'])) . '-' . $size,
                    'size' => $size,
                    'price' => $index === 0 ? $data['price'] : $data['price'] * 1.8, // 100ml is roughly double price
                    'stock' => rand(10, 100),
                ]);
            }
        }
    }
}
