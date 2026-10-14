<?php

namespace App\Services\SEO;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Faq;
use App\Models\Product;
use Illuminate\Support\Str;

class SeoService
{
    /**
     * Generate Schema.org Organization (JewelryStore) JSON-LD.
     */
    public static function getOrganizationSchema(): array
    {
        $baseUrl = url('/');
        $logoUrl = asset('assets/images/brand-story.jpg');

        return [
            '@context' => 'https://schema.org',
            '@type' => 'JewelryStore',
            '@id' => "{$baseUrl}/#organization",
            'name' => "Modern's Jewellery House",
            'legalName' => "Modern's Jewellery House Fine Atelier L.L.C.",
            'url' => $baseUrl,
            'logo' => [
                '@type' => 'ImageObject',
                '@id' => "{$baseUrl}/#logo",
                'url' => $logoUrl,
                'contentUrl' => $logoUrl,
                'caption' => "Modern's Jewellery House Logo",
            ],
            'image' => [
                '@type' => 'ImageObject',
                'url' => asset('assets/images/hero-luxury.jpg'),
            ],
            'description' => 'Contemporary fine jewellery and haute lapidary atelier combining timeless Old-World craftsmanship with modern architectural design.',
            'telephone' => '+971-4-800-LUXORA',
            'email' => 'concierge@modernjewelleryhouse.com',
            'priceRange' => '$$$$',
            'currenciesAccepted' => 'AED, USD, EUR, GBP',
            'paymentAccepted' => 'Credit Card, Debit Card, Wire Transfer',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Level 42, Almas Tower, Jumeirah Lakes Towers',
                'addressLocality' => 'Dubai',
                'addressRegion' => 'Dubai',
                'postalCode' => 'PO Box 3341',
                'addressCountry' => 'AE',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => 25.0683,
                'longitude' => 55.1436,
            ],
            'openingHoursSpecification' => [
                [
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                    'opens' => '10:00',
                    'closes' => '20:00',
                ],
            ],
            'sameAs' => [
                'https://www.instagram.com/modernjewelleryhouse',
                'https://www.pinterest.com/modernjewelleryhouse',
                'https://www.facebook.com/modernjewelleryhouse',
            ],
        ];
    }

    /**
     * Generate Schema.org WebSite JSON-LD with Sitelinks Searchbox.
     */
    public static function getWebSiteSchema(): array
    {
        $baseUrl = url('/');

        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => "{$baseUrl}/#website",
            'name' => "Modern's Jewellery House",
            'url' => $baseUrl,
            'publisher' => [
                '@id' => "{$baseUrl}/#organization",
            ],
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => "{$baseUrl}/shop?q={search_term_string}",
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    /**
     * Generate Schema.org BreadcrumbList JSON-LD.
     *
     * @param array<int, array{name: string, url?: string}> $items
     */
    public static function getBreadcrumbSchema(array $items): array
    {
        $elements = [];
        $position = 1;

        // Always start with Home
        $elements[] = [
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => 'Home',
            'item' => url('/'),
        ];

        foreach ($items as $item) {
            $element = [
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $item['name'],
            ];

            if (!empty($item['url'])) {
                $element['item'] = $item['url'];
            }

            $elements[] = $element;
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $elements,
        ];
    }

    /**
     * Generate Schema.org Product + Offer JSON-LD.
     * Only emits real reviews and ratings if legitimate reviews exist in database.
     */
    public static function getProductSchema(Product $product): array
    {
        $baseUrl = url('/');
        $productUrl = route('products.show', $product->slug);

        // Collect all high-resolution product images
        $images = [];
        if ($product->primaryImage && !empty($product->primaryImage->image_path)) {
            $images[] = asset($product->primaryImage->image_path);
        }
        foreach ($product->images as $img) {
            if (!empty($img->image_path)) {
                $images[] = asset($img->image_path);
            }
        }
        if (empty($images)) {
            $images[] = asset('assets/images/hero-luxury.jpg');
        }
        $images = array_values(array_unique($images));

        // Clean plain-text description
        $description = strip_tags($product->short_description ?: $product->description ?: $product->name);
        $description = Str::limit(trim(preg_replace('/\s+/', ' ', $description)), 400);

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            '@id' => "{$productUrl}#product",
            'name' => $product->name,
            'description' => $description,
            'sku' => $product->sku ?: "MJH-{$product->id}",
            'url' => $productUrl,
            'image' => $images,
            'brand' => [
                '@type' => 'Brand',
                'name' => 'Modern Jewellery House',
            ],
            'category' => $product->category?->name ?? 'Fine Jewellery',
            'material' => $product->metal_type ?: '18K Gold',
            'offers' => [
                '@type' => 'Offer',
                'url' => $productUrl,
                'priceCurrency' => 'AED',
                'price' => number_format((float) $product->base_price, 2, '.', ''),
                'priceValidUntil' => now()->addYear()->format('Y-12-31'),
                'itemCondition' => 'https://schema.org/NewCondition',
                'availability' => ($product->is_active && $product->status === 'published')
                    ? 'https://schema.org/InStock'
                    : 'https://schema.org/OutOfStock',
                'seller' => [
                    '@type' => 'Organization',
                    'name' => 'Modern Jewellery House',
                    'url' => $baseUrl,
                ],
                'shippingDetails' => [
                    '@type' => 'OfferShippingDetails',
                    'shippingRate' => [
                        '@type' => 'MonetaryAmount',
                        'value' => '0.00',
                        'currency' => 'AED',
                    ],
                    'shippingDestination' => [
                        '@type' => 'DefinedRegion',
                        'addressCountry' => ['AE', 'SA', 'QA', 'KW', 'BH', 'OM', 'US', 'GB'],
                    ],
                    'deliveryTime' => [
                        '@type' => 'ShippingDeliveryTime',
                        'businessDays' => [
                            '@type' => 'OpeningHoursSpecification',
                            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                        ],
                        'cutoffTime' => '17:00:00+04:00',
                        'handlingTime' => [
                            '@type' => 'QuantitativeValue',
                            'minValue' => 1,
                            'maxValue' => 2,
                            'unitCode' => 'd',
                        ],
                        'transitTime' => [
                            '@type' => 'QuantitativeValue',
                            'minValue' => 2,
                            'maxValue' => 4,
                            'unitCode' => 'd',
                        ],
                    ],
                ],
                'hasMerchantReturnPolicy' => [
                    '@type' => 'MerchantReturnPolicy',
                    'applicableCountry' => 'AE',
                    'returnPolicyCategory' => 'https://schema.org/MerchantReturnFiniteReturnWindow',
                    'merchantReturnDays' => 14,
                    'returnMethod' => 'https://schema.org/ReturnByMail',
                    'returnFees' => 'https://schema.org/FreeReturn',
                ],
            ],
        ];

        // Legitimate Reviews ONLY (Do NOT generate fake review information)
        if ($product->relationLoaded('reviews') || $product->reviews()->exists()) {
            $approvedReviews = $product->reviews()->where('is_approved', true)->with('user')->get();
            if ($approvedReviews->isNotEmpty()) {
                $avgRating = (float) $approvedReviews->avg('rating');
                $ratingCount = $approvedReviews->count();

                $schema['aggregateRating'] = [
                    '@type' => 'AggregateRating',
                    'ratingValue' => number_format($avgRating, 1, '.', ''),
                    'reviewCount' => $ratingCount,
                    'bestRating' => '5',
                    'worstRating' => '1',
                ];

                $reviewItems = [];
                foreach ($approvedReviews->take(5) as $rev) {
                    $reviewItems[] = [
                        '@type' => 'Review',
                        'author' => [
                            '@type' => 'Person',
                            'name' => $rev->user?->name ?? 'Verified Patron',
                        ],
                        'datePublished' => $rev->created_at?->format('Y-m-d') ?? now()->format('Y-m-d'),
                        'reviewBody' => $rev->comment ?? '',
                        'reviewRating' => [
                            '@type' => 'Rating',
                            'ratingValue' => (string) $rev->rating,
                            'bestRating' => '5',
                            'worstRating' => '1',
                        ],
                    ];
                }
                $schema['review'] = $reviewItems;
            }
        }

        return $schema;
    }

    /**
     * Generate Schema.org FAQPage JSON-LD.
     *
     * @param iterable<Faq>|array $faqs
     */
    public static function getFaqSchema($faqs): array
    {
        $entities = [];

        foreach ($faqs as $faq) {
            $question = is_array($faq) ? ($faq['question'] ?? '') : ($faq->question ?? '');
            $answer = is_array($faq) ? ($faq['answer'] ?? '') : ($faq->answer ?? '');

            if (!empty($question) && !empty($answer)) {
                $entities[] = [
                    '@type' => 'Question',
                    'name' => trim(strip_tags($question)),
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => trim(strip_tags($answer)),
                    ],
                ];
            }
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $entities,
        ];
    }
}
