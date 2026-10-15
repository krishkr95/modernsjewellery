<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'collection_id',
        'name',
        'slug',
        'sku',
        'tagline',
        'short_description',
        'description',
        'metal_type',
        'purity',
        'weight',
        'gemstone_type',
        'stone',
        'certification',
        'certificate_number',
        'certificate_file',
        'dimensions',
        'occasion',
        'available_sizes',
        '3d_model_url',
        '3d_model_provider',
        '3d_model_enabled',
        '3d_model_settings',
        'viewer_type',
        'rating',
        'reviews_count',
        'base_price',
        'compare_at_price',
        'cost_price',
        'badge',
        'is_featured',
        'is_new_arrival',
        'is_bestseller',
        'is_active',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'compare_at_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'rating' => 'decimal:2',
        'reviews_count' => 'integer',
        'is_featured' => 'boolean',
        'is_new_arrival' => 'boolean',
        'is_bestseller' => 'boolean',
        'is_active' => 'boolean',
        '3d_model_enabled' => 'boolean',
        '3d_model_settings' => 'array',
        'available_sizes' => 'array',
        'published_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function defaultVariant(): HasOne
    {
        return $this->hasOne(ProductVariant::class)->where('is_default', true);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function primaryImage(): HasOne
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function getPrimaryImageUrlAttribute(): string
    {
        if ($this->primaryImage) {
            return $this->primaryImage->url;
        }
        $first = $this->images->first();
        if ($first) {
            return $first->url;
        }
        return asset('assets/images/hero-luxury.jpg');
    }

    public function videos(): HasMany
    {
        return $this->hasMany(ProductVideo::class)->orderBy('sort_order');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)->where('is_approved', true)->latest();
    }

    public function allReviews(): HasMany
    {
        return $this->hasMany(Review::class)->latest();
    }

    public function getAverageRatingAttribute(): float
    {
        $avg = $this->reviews()->avg('rating');
        return $avg ? round((float) $avg, 1) : 4.9;
    }

    public function getTotalReviewsCountAttribute(): int
    {
        return $this->reviews()->count();
    }

    public function recentlyViewed(): HasMany
    {
        return $this->hasMany(RecentlyViewedProduct::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getFormattedPriceAttribute(): string
    {
        return '₹ ' . number_format($this->base_price, 0);
    }

    public function getFormattedComparePriceAttribute(): ?string
    {
        return $this->compare_at_price ? '₹ ' . number_format($this->compare_at_price, 0) : null;
    }

    public function getDiscountPercentAttribute(): ?int
    {
        if ($this->compare_at_price && $this->compare_at_price > $this->base_price) {
            return (int) round((($this->compare_at_price - $this->base_price) / $this->compare_at_price) * 100);
        }
        return null;
    }

    /**
     * Determine prominent luxury badge: NEW, BESTSELLER, LIMITED, SALE
     */
    public function getEffectiveBadgeAttribute(): ?string
    {
        if (!empty($this->badge)) {
            return strtoupper($this->badge);
        }
        if ($this->compare_at_price && $this->compare_at_price > $this->base_price) {
            return 'SALE';
        }
        if ($this->is_bestseller) {
            return 'BESTSELLER';
        }
        if ($this->is_new_arrival) {
            return 'NEW';
        }
        return null;
    }

    public function getHas3dModelAttribute(): bool
    {
        return (bool) ($this->getAttribute('3d_model_enabled') && !empty($this->getAttribute('3d_model_url')));
    }

    public function getModel3dUrlAttribute(): ?string
    {
        return $this->getAttribute('3d_model_url');
    }

    public function getModel3dProviderAttribute(): string
    {
        $provider = $this->getAttribute('3d_model_provider');
        if (empty($provider) || $provider === 'model-viewer') {
            if ($this->model_3d_url && (str_contains($this->model_3d_url, 'rendermyjewelry.com') || str_contains($this->model_3d_url, 'rendermyjewelry'))) {
                return 'rendermyjewelry';
            }
        }
        return $provider ?: 'model-viewer';
    }

    public function getIsRenderMyJewelryAttribute(): bool
    {
        if (empty($this->model_3d_url)) {
            return false;
        }
        return str_contains($this->model_3d_url, 'rendermyjewelry.com') || $this->model_3d_provider === 'rendermyjewelry';
    }

    public function getModel3dEnabledAttribute(): bool
    {
        return (bool) $this->getAttribute('3d_model_enabled');
    }

    public function getModel3dSettingsAttribute(): array
    {
        $settings = $this->getAttribute('3d_model_settings');
        if (is_string($settings)) {
            $settings = json_decode($settings, true);
        }
        $defaults = [
            'autorotate' => true,
            'speed' => 'slow',
            'show_colors' => true,
            'default_color' => 'yellow',
            'bg_color' => '#0d0d0f',
            'smoothness' => 'ultra',
        ];
        return is_array($settings) ? array_merge($defaults, $settings) : $defaults;
    }
}
