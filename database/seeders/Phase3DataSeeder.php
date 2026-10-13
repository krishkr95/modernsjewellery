<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class Phase3DataSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        $badges = ['BESTSELLER', 'NEW', 'LIMITED', 'SALE', 'NEW', 'BESTSELLER'];
        $occasions = ['Bridal', 'Everyday Luxury', 'Gala & Evening', 'Anniversary', 'Cocktail & Soirée'];
        $purities = [
            '18K Yellow Gold (Au 750)',
            'Platinum 950 (Pt 950)',
            '18K White Gold (Au 750)',
            '18K Rose Gold (Au 750)',
            '18K Two-Tone Gold & Platinum'
        ];
        $certifications = [
            'Gemological Institute of America (GIA)',
            'International Gemological Institute (IGI)',
            'Gübelin Gem Lab Lucerne',
            'SSEF Swiss Gemmological Institute'
        ];

        foreach ($products as $idx => $prod) {
            $badge = $badges[$idx % count($badges)];
            $occasion = $occasions[$idx % count($occasions)];
            $purity = $purities[$idx % count($purities)];
            $cert = $certifications[$idx % count($certifications)];
            $certNumber = 'GIA-' . (248100000 + ($idx * 379));

            // Set up sizes
            $sizes = ['14', '16', '18', '20'];
            if (str_contains(strtolower($prod->name), 'necklace')) {
                $sizes = ['16"', '18"', '20"'];
            } elseif (str_contains(strtolower($prod->name), 'bracelet') || str_contains(strtolower($prod->name), 'cuff')) {
                $sizes = ['16cm', '17.5cm', '19cm'];
            } elseif (str_contains(strtolower($prod->name), 'earring')) {
                $sizes = ['Standard Atelier Drop'];
            }

            // Flagship 3D model for first 3 products
            $has3d = ($idx < 3);
            $modelUrl = $has3d ? 'https://modelviewer.dev/shared-assets/models/Astronaut.glb' : null;

            $prod->update([
                'badge' => $badge,
                'occasion' => $occasion,
                'purity' => $purity,
                'weight' => (3.8 + ($idx * 1.65)) . ' g',
                'stone' => $prod->stone ?: ($prod->gemstone_type ?: 'Natural Brilliant Diamonds, VVS1, E-F Color'),
                'certification' => $cert,
                'certificate_number' => $certNumber,
                'certificate_file' => 'sample-certificate.pdf',
                'dimensions' => 'Width: ' . (2.1 + ($idx * 0.4)) . 'mm | Depth: 6.8mm',
                'available_sizes' => $sizes,
                '3d_model_url' => $modelUrl,
                '3d_model_provider' => 'model-viewer',
                '3d_model_enabled' => $has3d,
                'rating' => 4.88 + (($idx % 3) * 0.05),
                'reviews_count' => 12 + ($idx * 4),
            ]);
        }
    }
}
