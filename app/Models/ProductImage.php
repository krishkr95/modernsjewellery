<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'variant_id',
        'image_path',
        'alt_text',
        'sort_order',
        'is_primary',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_primary' => 'boolean',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function getUrlAttribute(): string
    {
        if (empty($this->image_path)) {
            return asset('assets/images/hero-luxury.jpg');
        }
        if (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://')) {
            return $this->image_path;
        }
        $cleanPath = ltrim($this->image_path, '/');
        if (str_starts_with($cleanPath, 'assets/')) {
            return asset($cleanPath);
        }
        if (str_starts_with($cleanPath, 'storage/')) {
            return asset($cleanPath);
        }
        return asset('storage/' . $cleanPath);
    }

}
