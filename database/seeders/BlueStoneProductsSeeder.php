<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Support\Str;

class BlueStoneProductsSeeder extends Seeder
{
    public function run(): void
    {
        $ringsCat = Category::firstOrCreate(
            ['slug' => 'rings'],
            ['name' => 'Rings', 'is_active' => true, 'sort_order' => 1]
        );

        $ringProducts = [
            ['name' => 'The Della Ring', 'price' => 16564, 'mrp' => 22085, 'offer' => '50% off on Making Charges', 'metal' => '18Kt White Gold, Diamonds'],
            ['name' => 'The Ricarda Ring', 'price' => 24180, 'mrp' => 28450, 'offer' => '50% off on Making Charges', 'metal' => '18Kt Two-Tone Gold, Diamonds'],
            ['name' => 'The Danita Ring', 'price' => 21650, 'mrp' => 26000, 'offer' => '50% off on Making Charges', 'metal' => '18Kt Rose Gold, Diamonds'],
            ['name' => 'The Euphemia Ring', 'price' => 18420, 'mrp' => 20466, 'offer' => '10% off on Making Charges', 'metal' => '22Kt Yellow Gold'],
            ['name' => 'The Mirabella Band', 'price' => 23100, 'mrp' => 25666, 'offer' => '10% off on Making Charges', 'metal' => '18Kt Yellow Gold'],
            ['name' => 'The Carlotta Ring', 'price' => 19850, 'mrp' => 24812, 'offer' => '50% off on Making Charges', 'metal' => '18Kt Rose Gold, Diamonds'],
            ['name' => 'The Valeria Pavé Ring', 'price' => 27400, 'mrp' => 34250, 'offer' => '50% off on Making Charges', 'metal' => '18Kt Yellow Gold, Diamonds'],
            ['name' => 'The Aurelia Pearl Ring', 'price' => 31200, 'mrp' => 39000, 'offer' => '50% off on Making Charges', 'metal' => '18Kt Yellow Gold, Fresh Pearl'],
            ['name' => 'The Signet Enamel Ring', 'price' => 52054, 'mrp' => 57837, 'offer' => '10% off on Making Charges', 'metal' => '18Kt Yellow Gold, Black Enamel'],
            ['name' => 'The Onyx Duo Ring', 'price' => 19420, 'mrp' => 24275, 'offer' => '50% off on Making Charges', 'metal' => '18Kt Rose Gold, Black Onyx'],
            ['name' => 'The Grand Pavé Cluster', 'price' => 61400, 'mrp' => 76750, 'offer' => '50% off on Making Charges', 'metal' => '18Kt White Gold, 1.2ct Diamonds'],
            ['name' => 'The Twin Infinity Ring', 'price' => 15129, 'mrp' => 16810, 'offer' => '10% off on Making Charges', 'metal' => '18Kt Two-Tone Gold'],
            ['name' => 'The Classic Comfort Band', 'price' => 14560, 'mrp' => 16177, 'offer' => '10% off on Making Charges', 'metal' => '22Kt Yellow Gold'],
            ['name' => 'The Geometric Open Band', 'price' => 24800, 'mrp' => 31000, 'offer' => '50% off on Making Charges', 'metal' => '18Kt Yellow Gold'],
            ['name' => 'The Triangle Solitaire Ring', 'price' => 18900, 'mrp' => 23625, 'offer' => '50% off on Making Charges', 'metal' => '18Kt Rose Gold, Diamond'],
            ['name' => 'The Bold Domed Gold Band', 'price' => 46700, 'mrp' => 51888, 'offer' => '10% off on Making Charges', 'metal' => '22Kt Yellow Gold'],
            ['name' => 'The Full Eternity Band', 'price' => 48200, 'mrp' => 60250, 'offer' => '50% off on Making Charges', 'metal' => '18Kt White Gold, Diamonds'],
            ['name' => 'The Rectangular Silhouette Ring', 'price' => 16400, 'mrp' => 18222, 'offer' => '10% off on Making Charges', 'metal' => '18Kt Yellow Gold'],
            ['name' => 'The Ceramic Fusion Ring', 'price' => 28900, 'mrp' => 36125, 'offer' => '50% off on Making Charges', 'metal' => '18Kt Yellow Gold, Black Ceramic'],
            ['name' => 'The Baron Diamond Signet', 'price' => 58400, 'mrp' => 64888, 'offer' => '10% off on Making Charges', 'metal' => '18Kt Yellow Gold, Pavé Diamonds'],
            ['name' => 'The Criss Cross Diamond Band', 'price' => 36800, 'mrp' => 46000, 'offer' => '50% off on Making Charges', 'metal' => '18Kt Rose Gold, Diamonds'],
            ['name' => 'The Marquise Crown Ring', 'price' => 32100, 'mrp' => 40125, 'offer' => '50% off on Making Charges', 'metal' => '18Kt Yellow Gold, Marquise Diamond'],
            ['name' => 'The Bypass Twirl Ring', 'price' => 22500, 'mrp' => 28125, 'offer' => '50% off on Making Charges', 'metal' => '18Kt Yellow Gold, Diamonds'],
            ['name' => 'The Splendour Multi-Row Ring', 'price' => 75800, 'mrp' => 94750, 'offer' => '50% off on Making Charges', 'metal' => '18Kt Rose & White Gold, Diamonds'],
        ];

        $stockImages = [
            'assets/images/collection-rings.jpg',
            'assets/images/aurelia-solitaire-diamond-ring-1.jpg',
            'assets/images/aurelia-solitaire-diamond-ring-2.jpg',
            'assets/images/rings_fork.jpg',
            'assets/images/wish_flower_ring.jpg',
        ];

        foreach ($ringProducts as $index => $item) {
            $slug = Str::slug($item['name']);
            $product = Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $ringsCat->id,
                    'name' => $item['name'],
                    'sku' => 'BS-RNG-' . str_pad($index + 101, 4, '0', STR_PAD_LEFT),
                    'tagline' => 'Certified Hallmark 18Kt / 22Kt Gold',
                    'short_description' => 'Precision crafted design with conflict-free diamonds and BIS hallmarked precious gold.',
                    'description' => 'Discover exceptional brilliance with ' . $item['name'] . ', inspired by contemporary Indian architectural forms and timeless heirloom motifs.',
                    'metal_type' => $item['metal'],
                    'purity' => str_contains($item['metal'], '22Kt') ? '22K' : '18K',
                    'weight' => round(2.5 + ($index * 0.25), 2),
                    'certification' => 'BIS Hallmarked & SGL Certified',
                    'base_price' => $item['price'],
                    'compare_at_price' => $item['mrp'],
                    'is_featured' => true,
                    'is_new_arrival' => ($index % 3 === 0),
                    'is_bestseller' => ($index < 8),
                    'is_active' => true,
                    'status' => 'published',
                    'rating' => round(4.6 + (($index % 5) * 0.08), 1),
                    'reviews_count' => 12 + ($index * 7),
                ]
            );

            // Add images
            $imgChoice = $stockImages[$index % count($stockImages)];
            $secChoice = $stockImages[($index + 1) % count($stockImages)];

            ProductImage::firstOrCreate(
                ['product_id' => $product->id, 'is_primary' => true],
                ['image_path' => $imgChoice, 'sort_order' => 0]
            );

            ProductImage::firstOrCreate(
                ['product_id' => $product->id, 'is_primary' => false],
                ['image_path' => $secChoice, 'sort_order' => 1]
            );

            // Add default variant
            $variant = ProductVariant::firstOrCreate(
                ['product_id' => $product->id, 'is_default' => true],
                [
                    'sku' => $product->sku . '-SZ14',
                    'title' => 'Size 14 - ' . $item['metal'],
                    'size' => '14',
                    'metal_color' => 'Yellow Gold',
                    'price' => $item['price'],
                    'compare_at_price' => $item['mrp'],
                    'is_active' => true,
                ]
            );

            \App\Models\Inventory::firstOrCreate(
                ['product_variant_id' => $variant->id],
                [
                    'quantity' => 10,
                    'reserved_quantity' => 0,
                    'low_stock_threshold' => 2,
                ]
            );
        }
    }
}

