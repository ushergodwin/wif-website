<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'objectives',
        'target_beneficiaries',
        'activities',
        'impact_summary',
        'featured_image',
        'gallery_images',
        'video_url',
        'is_featured',
        'is_active',
        'order',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug) && !empty($project->title)) {
                $project->slug = Str::slug($project->title);
            }
        });

        static::updating(function ($project) {
            if (empty($project->slug) && !empty($project->title)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function galleryItems(): HasMany
    {
        return $this->hasMany(GalleryItem::class);
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        if (!$this->featured_image) {
            return null;
        }
        
        if (str_starts_with($this->featured_image, 'http')) {
            return $this->featured_image;
        }
        
        return asset('storage/' . $this->featured_image);
    }

    public function getGalleryImagesUrlsAttribute(): array
    {
        if (!$this->gallery_images || !is_array($this->gallery_images)) {
            return [];
        }
        
        return array_map(function ($image) {
            if (str_starts_with($image, 'http')) {
                return $image;
            }
            return asset('storage/' . $image);
        }, $this->gallery_images);
    }
}
