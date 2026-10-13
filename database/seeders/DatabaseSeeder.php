<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Coupon;
use App\Models\Faq;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Role;
use App\Models\Setting;
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
        $this->call(RoleSeeder::class);

        $superAdminRole = Role::where('name', Role::SUPER_ADMIN)->first();
        $customerRole = Role::where('name', Role::CUSTOMER)->first();

        // Super Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@modernjewelleryhouse.com'],
            [
                'name' => 'Alexander Vance',
                'password' => Hash::make('Secret@12345'),
                'phone' => '+1 (212) 555-0198',
                'role_id' => $superAdminRole->id,
                'status' => 'active',
                'last_login_at' => now(),
            ]
        );
        $admin->roles()->syncWithoutDetaching([$superAdminRole->id]);

        // Sample Customer
        $customer = User::firstOrCreate(
            ['email' => 'elena@modernjewelleryhouse.com'],
            [
                'name' => 'Elena Rostova',
                'password' => Hash::make('Secret@12345'),
                'phone' => '+1 (415) 555-0142',
                'role_id' => $customerRole->id,
                'status' => 'active',
                'last_login_at' => now(),
            ]
        );
        $customer->roles()->syncWithoutDetaching([$customerRole->id]);

        // Categories
        $categoriesData = [
            [
                'name' => 'Rings',
                'slug' => 'rings',
                'description' => 'Sculptural solitaires, ceremonial bands, and statement cocktail rings fashioned in 18k gold and platinum.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Necklaces',
                'slug' => 'necklaces',
                'description' => 'Delicate diamond colliers, bespoke pendants, and cascade chains calibrated for timeless grace.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Earrings',
                'slug' => 'earrings',
                'description' => 'Architectural drops, pavé huggies, and high jewellery chandeliers capturing every facet of light.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Bracelets',
                'slug' => 'bracelets',
                'description' => 'Rigid cuff bracelets, articulated tennis ribbons, and sculptural chains engineered for subtle presence.',
                'sort_order' => 4,
            ],
            [
                'name' => 'High Jewellery',
                'slug' => 'high-jewellery',
                'description' => 'One-of-a-kind masterworks handcrafted by master lapidaries with rare untreated gemstones.',
                'sort_order' => 5,
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[$cat['slug']] = Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        // Collections
        $collectionsData = [
            [
                'name' => 'Heritage Noir',
                'slug' => 'heritage-noir',
                'subtitle' => 'Bold contrasts in blackened platinum and emerald-cut solitaire diamonds',
                'description' => 'A nocturnal dialogue between shadow and luminescence, designed for the modern connoisseur.',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'name' => "L'Aura Eternelle",
                'slug' => 'laura-eternelle',
                'subtitle' => 'Fluid curves in warm 18k yellow gold and river pearls',
                'description' => 'Organic contours echoing classical antiquity through a minimalist contemporary sensibility.',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Solitaire Lumière',
                'slug' => 'solitaire-lumiere',
                'subtitle' => 'Purist diamond solitaires cut to ideal optical symmetry',
                'description' => 'The purest expression of light, featuring conflict-free diamonds set in whisper-thin bezel and prongs.',
                'is_featured' => true,
                'sort_order' => 3,
            ],
        ];

        $collections = [];
        foreach ($collectionsData as $col) {
            $collections[$col['slug']] = Collection::firstOrCreate(['slug' => $col['slug']], $col);
        }

        // Luxury Products
        $productsData = [
            [
                'name' => 'The Aurelia Solitaire Diamond Ring',
                'slug' => 'aurelia-solitaire-diamond-ring',
                'sku' => 'MJH-RNG-001',
                'tagline' => 'A 2.15ct cushion-cut brilliant diamond seated in sculptural 18k yellow gold',
                'short_description' => 'Cast in warm 18k gold with a knife-edge band and hidden pavé gallery for unmatched scintillation.',
                'description' => 'The Aurelia Solitaire is hand-forged in our atelier, centering a GIA-certified 2.15-carat cushion brilliant diamond of F colour and VVS1 clarity. The whisper-thin knife-edge shank creates the illusion that the diamond floats weightlessly above the finger, illuminated from beneath by a concealed platinum under-halo.',
                'category_slug' => 'rings',
                'collection_slug' => 'solitaire-lumiere',
                'metal_type' => '18k Yellow Gold & Platinum',
                'gemstone_type' => 'Natural Diamond (2.15ct, F / VVS1)',
                'base_price' => 14800.00,
                'compare_at_price' => 16500.00,
                'is_featured' => true,
                'is_new_arrival' => false,
                'is_bestseller' => true,
                'variants' => [
                    ['title' => 'Size 6 / 18k Yellow Gold', 'metal_color' => 'Yellow Gold', 'size' => '6', 'price' => 14800.00, 'stock' => 3, 'is_default' => true],
                    ['title' => 'Size 7 / 18k Yellow Gold', 'metal_color' => 'Yellow Gold', 'size' => '7', 'price' => 14800.00, 'stock' => 2, 'is_default' => false],
                    ['title' => 'Size 6 / Platinum 950', 'metal_color' => 'Platinum', 'size' => '6', 'price' => 15600.00, 'stock' => 1, 'is_default' => false],
                ],
            ],
            [
                'name' => 'Étoile Cascade Diamond Collier',
                'slug' => 'etoile-cascade-diamond-collier',
                'sku' => 'MJH-NCK-002',
                'tagline' => 'Graduated emerald-cut diamonds articulating along the collarbone',
                'short_description' => 'An articulated line of 42 emerald-cut diamonds totaling 9.40 carats in solid 18k white gold.',
                'description' => 'Articulated with seamless mechanical precision, the Étoile Cascade necklace rests against the neckline like liquid light. Each diamond has been hand-selected for matching depth ratio and table percentage, culminating in a drop of architectural elegance.',
                'category_slug' => 'necklaces',
                'collection_slug' => 'heritage-noir',
                'metal_type' => '18k White Gold',
                'gemstone_type' => 'Emerald-Cut Diamonds (9.40ct total)',
                'base_price' => 28500.00,
                'compare_at_price' => null,
                'is_featured' => true,
                'is_new_arrival' => true,
                'is_bestseller' => false,
                'variants' => [
                    ['title' => '16-Inch Choker Length', 'metal_color' => 'White Gold', 'size' => '16"', 'price' => 28500.00, 'stock' => 2, 'is_default' => true],
                    ['title' => '18-Inch Standard Collar', 'metal_color' => 'White Gold', 'size' => '18"', 'price' => 31200.00, 'stock' => 1, 'is_default' => false],
                ],
            ],
            [
                'name' => 'Paloma Sculptural Gold Cuff',
                'slug' => 'paloma-sculptural-gold-cuff',
                'sku' => 'MJH-BRC-003',
                'tagline' => 'Hand-satinized heavy 18k yellow gold with fluted taper edges',
                'short_description' => 'Bold contemporary minimalism with an ergonomic hinged clasp and brushed silk finish.',
                'description' => 'Substantial yet feather-light on the wrist, the Paloma Cuff is hand-sculpted in solid 18k gold. The exterior features a hand-hammered satin finish while the interior is polished to a mirror gleam, offering an intimate tactile sensation throughout the day.',
                'category_slug' => 'bracelets',
                'collection_slug' => 'laura-eternelle',
                'metal_type' => '18k Yellow Gold',
                'gemstone_type' => 'None (Pure 18k Solid Gold)',
                'base_price' => 8900.00,
                'compare_at_price' => null,
                'is_featured' => true,
                'is_new_arrival' => true,
                'is_bestseller' => true,
                'variants' => [
                    ['title' => 'Small (15.5cm wrist)', 'metal_color' => 'Yellow Gold', 'size' => 'S', 'price' => 8900.00, 'stock' => 4, 'is_default' => true],
                    ['title' => 'Medium (17cm wrist)', 'metal_color' => 'Yellow Gold', 'size' => 'M', 'price' => 9200.00, 'stock' => 3, 'is_default' => false],
                ],
            ],
            [
                'name' => 'Verdant Empress Colombian Emerald Drops',
                'slug' => 'verdant-empress-emerald-drops',
                'sku' => 'MJH-EAR-004',
                'tagline' => 'Matched Muzo Colombian emeralds framed by trapeze-cut diamonds',
                'short_description' => 'Unheated 4.80ct total emeralds radiating deep forest hue in 18k yellow gold bezels.',
                'description' => 'Culled from the fabled Muzo mines of Colombia, these emeralds possess the elusive “jardin” inner glow that defines true gemstone royalty. Accented with step-cut trapeze diamonds, they swing with graceful movement while remaining impeccably poised.',
                'category_slug' => 'earrings',
                'collection_slug' => 'heritage-noir',
                'metal_type' => '18k Yellow Gold & Platinum',
                'gemstone_type' => 'Colombian Emerald (4.80ct) & Diamonds (1.20ct)',
                'base_price' => 19200.00,
                'compare_at_price' => 21000.00,
                'is_featured' => true,
                'is_new_arrival' => false,
                'is_bestseller' => false,
                'variants' => [
                    ['title' => 'One Size / Post & French Clip', 'metal_color' => 'Yellow Gold', 'size' => 'Standard', 'price' => 19200.00, 'stock' => 1, 'is_default' => true],
                ],
            ],
            [
                'name' => 'Sovereign Diamond Tennis Bracelet',
                'slug' => 'sovereign-diamond-tennis-bracelet',
                'sku' => 'MJH-BRC-005',
                'tagline' => 'A continuous stream of bezel-set round brilliant diamonds in 18k white gold',
                'short_description' => '5.50 carats of VS1 diamonds engineered with a dual-safety concealed clasp.',
                'description' => 'A cornerstone piece reimagined. Rather than traditional prongs, each diamond is encased in a low-profile hexagonal bezel that prevents snagging and maximizes everyday wearability without losing an ounce of brilliance.',
                'category_slug' => 'bracelets',
                'collection_slug' => 'solitaire-lumiere',
                'metal_type' => '18k White Gold',
                'gemstone_type' => 'Round Brilliant Diamonds (5.50ct total)',
                'base_price' => 11400.00,
                'compare_at_price' => 12800.00,
                'is_featured' => false,
                'is_new_arrival' => true,
                'is_bestseller' => true,
                'variants' => [
                    ['title' => '7-Inch Length', 'metal_color' => 'White Gold', 'size' => '7"', 'price' => 11400.00, 'stock' => 5, 'is_default' => true],
                ],
            ],
            [
                'name' => 'Celestial Baroque Pearl Drop Pendant',
                'slug' => 'celestial-baroque-pearl-pendant',
                'sku' => 'MJH-NCK-006',
                'tagline' => 'Australian South Sea baroque pearl capped with 18k fluted gold and diamonds',
                'short_description' => 'A luminous 15mm natural pearl on an adjustable 20-inch diamond-cut wheat chain.',
                'description' => 'No two baroque pearls are identical. This piece honors natural asymmetry with an iridescent pearl hand-selected for its mirror-like orient luster, crowned by a starburst cap set with micro-pavé diamonds.',
                'category_slug' => 'necklaces',
                'collection_slug' => 'laura-eternelle',
                'metal_type' => '18k Yellow Gold',
                'gemstone_type' => 'South Sea Pearl (15mm) & Diamonds (0.35ct)',
                'base_price' => 5800.00,
                'compare_at_price' => null,
                'is_featured' => false,
                'is_new_arrival' => true,
                'is_bestseller' => false,
                'variants' => [
                    ['title' => 'Adjustable 18-20 Inch Chain', 'metal_color' => 'Yellow Gold', 'size' => '20"', 'price' => 5800.00, 'stock' => 3, 'is_default' => true],
                ],
            ],
        ];

        foreach ($productsData as $prod) {
            $cat = $categories[$prod['category_slug']];
            $col = $collections[$prod['collection_slug']] ?? null;

            $product = Product::updateOrCreate(
                ['slug' => $prod['slug']],
                [
                    'category_id' => $cat->id,
                    'collection_id' => $col?->id,
                    'name' => $prod['name'],
                    'sku' => $prod['sku'],
                    'tagline' => $prod['tagline'],
                    'short_description' => $prod['short_description'],
                    'description' => $prod['description'],
                    'metal_type' => $prod['metal_type'],
                    'gemstone_type' => $prod['gemstone_type'],
                    'base_price' => $prod['base_price'],
                    'compare_at_price' => $prod['compare_at_price'],
                    'is_featured' => $prod['is_featured'],
                    'is_new_arrival' => $prod['is_new_arrival'],
                    'is_bestseller' => $prod['is_bestseller'],
                    'is_active' => true,
                    'status' => 'published',
                    'published_at' => now(),
                    'meta_title' => "{$prod['name']} | Modern Jewellery House",
                    'meta_description' => $prod['short_description'],
                ]
            );

            // Images
            ProductImage::updateOrCreate(
                ['product_id' => $product->id, 'sort_order' => 0],
                [
                    'image_path' => "assets/images/{$prod['slug']}-1.jpg",
                    'alt_text' => "{$product->name} editorial studio front view",
                    'is_primary' => true,
                ]
            );
            ProductImage::updateOrCreate(
                ['product_id' => $product->id, 'sort_order' => 1],
                [
                    'image_path' => "assets/images/{$prod['slug']}-2.jpg",
                    'alt_text' => "{$product->name} on-model perspective and craftsmanship detail",
                    'is_primary' => false,
                ]
            );

            // Variants & Inventory
            foreach ($prod['variants'] as $vData) {
                $variant = ProductVariant::updateOrCreate(
                    ['product_id' => $product->id, 'sku' => "{$product->sku}-" . strtoupper(substr(md5($vData['title']), 0, 4))],
                    [
                        'title' => $vData['title'],
                        'metal_color' => $vData['metal_color'],
                        'size' => $vData['size'],
                        'price' => $vData['price'],
                        'is_default' => $vData['is_default'],
                        'is_active' => true,
                    ]
                );

                Inventory::updateOrCreate(
                    ['product_variant_id' => $variant->id],
                    [
                        'quantity' => $vData['stock'],
                        'reserved_quantity' => 0,
                        'low_stock_threshold' => 2,
                    ]
                );
            }
        }

        // Banners
        Banner::updateOrCreate(
            ['placement' => 'home_hero', 'sort_order' => 1],
            [
                'title' => 'The Architecture of Radiance',
                'subtitle' => 'High jewellery meticulously crafted for modern legacy.',
                'tagline' => 'AUTUMN / WINTER MAISON COLLECTION',
                'cta_text' => 'Explore Fine Jewellery',
                'cta_link' => route('products.index'),
                'image_desktop' => 'assets/images/hero-luxury.jpg',
                'is_active' => true,
            ]
        );

        Banner::updateOrCreate(
            ['placement' => 'announcement', 'sort_order' => 1],
            [
                'title' => 'Complimentary worldwide insured courier & bespoke gift presentation with every commission.',
                'cta_text' => 'Read Our Guarantees',
                'cta_link' => '#',
                'image_desktop' => '',
                'is_active' => true,
            ]
        );

        // FAQs
        $faqs = [
            [
                'category' => 'Craftsmanship',
                'question' => 'How are Modern Jewellery House diamonds sourced?',
                'answer' => 'Every diamond selected by our gemological directors is strictly conflict-free, adhering to the highest standards of the Kimberley Process and accompanied by GIA grading certificates.',
                'sort_order' => 1,
            ],
            [
                'category' => 'Craftsmanship',
                'question' => 'What precious metals are used in your creations?',
                'answer' => 'We forge solely in certified recycled 18-karat gold (yellow, rose, white) and 950 purity platinum, ensuring enduring structural integrity and hypoallergenic wear.',
                'sort_order' => 2,
            ],
            [
                'category' => 'Concierge & Delivery',
                'question' => 'How are creations shipped and insured?',
                'answer' => 'All shipments travel via armored courier with comprehensive door-to-door transit insurance and require an adult signature upon white-glove arrival.',
                'sort_order' => 3,
            ],
            [
                'category' => 'Services',
                'question' => 'Do you provide bespoke engraving and sizing?',
                'answer' => 'Yes. Complimentary laser or hand engraving is offered on eligible rings and pendants. Sizing adjustments are performed with pleasure within 60 days of delivery.',
                'sort_order' => 4,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(['question' => $faq['question']], $faq);
        }

        // Coupon
        Coupon::updateOrCreate(
            ['code' => 'MAISON10'],
            [
                'type' => 'percentage',
                'value' => 10.00,
                'min_order_amount' => 1000.00,
                'max_discount_amount' => 2000.00,
                'usage_limit' => 100,
                'is_active' => true,
            ]
        );

        // Settings
        $settings = [
            ['key' => 'brand_name', 'value' => 'Modern Jewellery House', 'group' => 'branding', 'type' => 'string'],
            ['key' => 'brand_tagline', 'value' => 'Contemporary Fine Jewellery & Haute Horlogerie', 'group' => 'branding', 'type' => 'string'],
            ['key' => 'concierge_phone', 'value' => '+1 (800) 492-9180', 'group' => 'contact', 'type' => 'string'],
            ['key' => 'concierge_email', 'value' => 'concierge@modernjewelleryhouse.com', 'group' => 'contact', 'type' => 'string'],
            ['key' => 'currency_symbol', 'value' => '$', 'group' => 'localization', 'type' => 'string'],
            ['key' => 'currency_code', 'value' => 'USD', 'group' => 'localization', 'type' => 'string'],
        ];

        foreach ($settings as $s) {
            Setting::set($s['key'], $s['value'], $s['group'], $s['type']);
        }
    }
}
