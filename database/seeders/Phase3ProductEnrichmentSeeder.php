<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class Phase3ProductEnrichmentSeeder extends Seeder
{
    public function run(): void
    {
        $enrichments = [
            'lumina-solitaire-diamond-ring' => [
                'badge' => 'BESTSELLER',
                'purity' => 'Platinum 950 & 18K Yellow Gold',
                'weight' => '4.85 g',
                'stone' => '1.52 ct Solitaire Round Brilliant Diamond (VS1, E Color, Excellent Cut)',
                'certification' => 'Gemological Institute of America (GIA)',
                'certificate_number' => 'GIA-2489104821',
                'certificate_file' => 'assets/documents/gia-certificate-sample.pdf',
                'dimensions' => 'Band: 2.2mm | Crown: 7.4mm height',
                'occasion' => 'Bridal',
                'available_sizes' => ['14', '16', '18', '20'],
                '3d_model_url' => 'https://modelviewer.dev/shared-assets/models/Astronaut.glb', // Fallback standard GLB
                '3d_model_provider' => 'model-viewer',
                '3d_model_enabled' => true,
                'rating' => 4.96,
                'reviews_count' => 24,
            ],
            'serpentine-pave-cuff-bracelet' => [
                'badge' => 'LIMITED',
                'purity' => '18K Rose Gold (Au 750)',
                'weight' => '18.40 g',
                'stone' => '2.40 ctw Pavé-Set Brilliant Cut Diamonds (VVS2, F Color)',
                'certification' => 'International Gemological Institute (IGI)',
                'certificate_number' => 'IGI-51829031',
                'dimensions' => 'Width: 6.5mm | Circumference: 165mm - 185mm',
                'occasion' => 'Gala & Evening',
                'available_sizes' => ['16', '17', '18'],
                '3d_model_url' => '',
                '3d_model_provider' => 'model-viewer',
                '3d_model_enabled' => false,
                'rating' => 4.90,
                'reviews_count' => 12,
            ],
            'celestial-cascade-drop-earrings' => [
                'badge' => 'NEW',
                'purity' => '18K White Gold (Au 750)',
                'weight' => '9.65 g',
                'stone' => '4.10 ctw Pear-shaped & Marquise Diamonds (VS1, D-E Color)',
                'certification' => 'Gemological Institute of America (GIA)',
                'certificate_number' => 'GIA-6391024820',
                'dimensions' => 'Length: 48mm | Drop width: 9mm',
                'occasion' => 'Gala & Evening',
                'available_sizes' => ['Standard Drop'],
                '3d_model_url' => '',
                '3d_model_provider' => 'model-viewer',
                '3d_model_enabled' => false,
                'rating' => 4.92,
                'reviews_count' => 19,
            ],
            'aurelia-emerald-eternity-band' => [
                'badge' => 'SALE',
                'purity' => '18K Yellow Gold (Au 750)',
                'weight' => '5.20 g',
                'stone' => '3.50 ctw Natural Zambian Vivid Green Emeralds & F-G Diamonds',
                'certification' => 'Gübelin Gem Lab',
                'certificate_number' => 'GUB-2026-9182',
                'dimensions' => 'Band width: 3.8mm',
                'occasion' => 'Anniversary',
                'available_sizes' => ['14', '16', '18', '20'],
                '3d_model_url' => 'https://modelviewer.dev/shared-assets/models/Astronaut.glb',
                '3d_model_provider' => 'model-viewer',
                '3d_model_enabled' => true,
                'rating' => 4.88,
                'reviews_count' => 15,
            ],
            'etoile-sapphire-pendant-necklace' => [
                'badge' => 'BESTSELLER',
                'purity' => 'Platinum 950',
                'weight' => '7.80 g',
                'stone' => '2.85 ct Royal Blue Royal Velvet Ceylon Sapphire, 0.65ct Diamonds',
                'certification' => 'Gemological Institute of America (GIA)',
                'certificate_number' => 'GIA-819203914',
                'dimensions' => 'Pendant: 16mm x 11mm | Chain: 42cm - 45cm',
                'occasion' => 'Everyday Luxury',
                'available_sizes' => ['16"', '18"', '20"'],
                '3d_model_url' => '',
                '3d_model_provider' => 'model-viewer',
                '3d_model_enabled' => false,
                'rating' => 4.98,
                'reviews_count' => 31,
            ],
            'baroque-pearl-statement-necklace' => [
                'badge' => 'NEW',
                'purity' => '18K Yellow Gold (Au 750)',
                'weight' => '24.10 g',
                'stone' => 'Graduated South Sea Cultured Pearls (12-15mm) with Diamond Clasp (0.35ct)',
                'certification' => 'Mikimoto Laboratory Assessment & MJH Certificate',
                'certificate_number' => 'MJH-SEA-9182',
                'dimensions' => 'Length: 46cm with concealed safety box clasp',
                'occasion' => 'Everyday Luxury',
                'available_sizes' => ['42cm', '45cm', '50cm'],
                '3d_model_url' => '',
                '3d_model_provider' => 'model-viewer',
                '3d_model_enabled' => false,
                'rating' => 4.95,
                'reviews_count' => 16,
            ],
        ];

        foreach ($enrichments as $slug => $data) {
            Product::where('slug', $slug)->update($data);
        }

        // For any other products, populate sensible defaults
        Product::whereNull('certification')->update([
            'purity' => '18K Yellow Gold (Au 750)',
            'weight' => '4.50 g',
            'certification' => 'Gemological Institute of America (GIA)',
            'certificate_number' => 'GIA-719302819',
            'dimensions' => 'Standard Maison Proportion',
            'occasion' => 'Everyday Luxury',
            'available_sizes' => ['14', '16', '18', '20'],
            'rating' => 4.90,
            'reviews_count' => 11,
        ]);
    }
}
