<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'tagline',
        'cta_text',
        'cta_link',
        'image_desktop',
        'image_mobile',
        'placement',
        'sort_order',
        'is_active',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>=', now());
            });
    }

    public function scopePlacement($query, string $placement)
    {
        return $query->where('placement', $placement);
    }

    public function getDesktopImageUrlAttribute(): ?string
    {
        if (empty($this->image_desktop)) {
            return null;
        }
        if (str_starts_with($this->image_desktop, 'http://') || str_starts_with($this->image_desktop, 'https://')) {
            return $this->image_desktop;
        }
        if (str_starts_with($this->image_desktop, 'assets/')) {
            return asset($this->image_desktop);
        }
        if (str_starts_with($this->image_desktop, 'storage/')) {
            return asset($this->image_desktop);
        }
        return asset('storage/' . $this->image_desktop);
    }

    public function getMobileImageUrlAttribute(): ?string
    {
        if (empty($this->image_mobile)) {
            return $this->desktop_image_url;
        }
        if (str_starts_with($this->image_mobile, 'http://') || str_starts_with($this->image_mobile, 'https://')) {
            return $this->image_mobile;
        }
        if (str_starts_with($this->image_mobile, 'assets/')) {
            return asset($this->image_mobile);
        }
        if (str_starts_with($this->image_mobile, 'storage/')) {
            return asset($this->image_mobile);
        }
        return asset('storage/' . $this->image_mobile);
    }
}
